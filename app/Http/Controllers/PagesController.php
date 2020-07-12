<?php

namespace App\Http\Controllers;

use App\Pertanyaan;
use App\Like;

class PagesController extends Controller
{
    public function index()
    {
        $pertanyaan = Pertanyaan::orderBy('created_at', 'desc')->paginate(4);
        return view('pages.index', ['pertanyaan' => $pertanyaan]);
    }

    public function about()
    {
        return view('pages.about');
    }

    public function show($id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);
        $likes = Like::where('pertanyaan_id', $id)->get();
        $count = 0;

        foreach ($likes as $like) {
            $count += $like->like;
        }

        return view('pages.show', [
            'count' => $count,
            'pertanyaan' => $pertanyaan
        ]);
    }
}
