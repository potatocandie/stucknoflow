<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Validator;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tag = Tag::all();
        return view('tag.index', ['tag' => $tag]);
    }

    public function show($id)
    {
        $tag = Tag::find($id);
        return view('tag.show', ['tag' => $tag]);
    }

    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('tag.edit', ['tag' => $tag]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'isi_tag' => ['required', 'max:255']
        ]);

        if ($validator->fails()) {
            $errors = '';
            foreach ($validator->messages()->all() as $message) {
                $errors .= $message . "<br>";
            }
            return back()->with('toast_error', $errors)->withInput();
        }

        $tag = Tag::find($id);
        $tag->isi_tag = $request->input('isi_tag');
        $tag->save();

        return redirect()->route('tag.show', $tag->id)->withToastSuccess('Tag Telah Diupdate!');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'isi_tag' => ['required', 'max:255']
        ]);

        if ($validator->fails()) {
            $errors = '';
            foreach ($validator->messages()->all() as $message) {
                $errors .= $message . "<br>";
            }
            return back()->with('toast_error', $errors)->withInput();
        }

        Tag::create([
            'isi_tag' => $request->isi_tag
        ])->save();

        return redirect()->route('tag.index')->withToastSuccess('Tag Berhasil Disimpan!');
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        return redirect()->route('tag.index')->withToastSuccess('Tag Berhasil Dihapus!');
    }
}
