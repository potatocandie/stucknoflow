<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, $commentable_id, $commentable_type)
    {
        $validator = Validator::make($request->all(), [
            'isi_comment' => ['required']
        ]);

        if ($validator->fails()) {
            $errors = '';
            foreach ($validator->messages()->all() as $message) {
                $errors .= $message . "<br>";
            }
            return back()->with('toast_error', $errors)->withInput();
        }

        $comment = new Comment;
        $comment->user_id = Auth::id();
        $comment->isi_comment = $request->isi_comment;
        $comment->commentable_id = $commentable_id;
        $comment->commentable_type = $commentable_type == "pertanyaan" ? 'App\Pertanyaan' : 'App\Jawaban';
        $comment->save();

        return back()->withToastSuccess('Komentar Ditambahkan!');
    }
}
