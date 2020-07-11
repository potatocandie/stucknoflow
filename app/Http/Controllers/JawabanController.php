<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Jawaban;
use Auth;

class JawabanController extends Controller
{
    public function store(Request $request, $id_pertanyaan)
    {
        $validator = Validator::make($request->all(), [
            'isi_jawaban' => ['required', 'max:255'],
        ]);

        if ($validator->fails()) {
            $errors = '';
            foreach ($validator->messages()->all() as $message) {
                $errors .= $message . "<br>";
            }
            return back()->with('toast_error', $errors)->withInput();
        }

        $jawaban = new Jawaban;
        $jawaban->isi_jawaban = $request->isi_jawaban;
        $jawaban->user_id = Auth::id();
        $jawaban->pertanyaan_id = $id_pertanyaan;
        $jawaban->save();

        return redirect()
            ->route('pages.show', $id_pertanyaan)
            ->withToastSuccess('Jawaban Telah Disimpan!');
    }
}
