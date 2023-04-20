<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request,Comment $comment,$id)
    {
        $comment->user_id = \Auth::user()->id;
        $comment->article_id = $id;
        $comment->comment = $request["comment"];
        $comment->save();

        return redirect(route('show.article',['article' => $id]));
    }
}
