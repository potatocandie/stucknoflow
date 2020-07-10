<?php

namespace App\Http\Controllers;

use App\Pertanyaan;

class PagesController extends Controller
{
    public function index()
    {
        $pertanyaan = Pertanyaan::all();
        return view('pages.index', ['pertanyaan' => $pertanyaan]);
    }

    public function about()
    {
        return view('pages.about');
    }

    public function show($id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);
        return view('pages.show', ['pertanyaan' => $pertanyaan]);
    }
}
