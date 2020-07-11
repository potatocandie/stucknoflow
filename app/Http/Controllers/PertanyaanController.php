<?php

namespace App\Http\Controllers;

use App\Pertanyaan;
use App\Tag;
use Illuminate\Http\Request;
use Auth;
use Validator;

class PertanyaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->user = Auth::user();
    }

    public function index()
    {
        $user = Auth::user();
        $pertanyaan = $user->pertanyaan;
        return view('pertanyaan.index', ['pertanyaan' => $pertanyaan]);
    }

    public function create()
    {
        $tag = Tag::all();
        return view('pertanyaan.create', ['tag' => $tag]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => ['required', 'unique:pertanyaan', 'max:255'],
            'isi' => ['required']
        ]);

        if ($validator->fails()) {
            $errors = '';
            foreach ($validator->messages()->all() as $message) {
                $errors .= $message . "<br>";
            }
            return back()->with('toast_error', $errors)->withInput();
        }

        $user = Auth::id();

        $pertanyaan = new Pertanyaan;
        $pertanyaan->judul = $request->judul;
        $pertanyaan->isi = $request->isi;
        $pertanyaan->user_id = $user;
        $pertanyaan->save();

        $pertanyaan->tag()->sync($request->tag, true);

        return redirect()->route('pertanyaan.index')->withToastSuccess('Pertanyaan Terkirim!');
    }

    public function show($id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);
        return view('pertanyaan.show', ['pertanyaan' => $pertanyaan]);
    }

    public function edit($id)
    {
        $tag = Tag::all();
        $pertanyaan = Pertanyaan::findOrFail($id);
        return view('pertanyaan.edit', ['pertanyaan' => $pertanyaan, 'tag' => $tag]);
    }

    public function update(Request $request, $id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'judul' => ['required', 'max:255', 'unique:pertanyaan,judul,' . $pertanyaan->id],
            'isi' => ['required']
        ]);

        if ($validator->fails()) {
            $errors = '';
            foreach ($validator->messages()->all() as $message) {
                $errors .= $message . "<br>";
            }
            return back()->with('toast_error', $errors)->withInput();
        }

        $pertanyaan->judul = $request->judul;
        $pertanyaan->isi = $request->isi;
        $pertanyaan->save();

        if (isset($request->tag)) {
            $pertanyaan->tag()->sync($request->tag, true);
        } else {
            $pertanyaan->tag()->sync([]);
        }

        return redirect()->route('pertanyaan.index')->withToastSuccess('Pertanyaan Telah Diupdate!');
    }

    public function destroy($id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);
        $pertanyaan->delete();

        return redirect()->route('pertanyaan.index')->withToastSuccess('Pertanyaan Berhasil Dihapus!');
    }
}
