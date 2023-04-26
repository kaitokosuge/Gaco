<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;


class LikeController extends Controller
{
    public function like($id,Like $like)
    {
        $like->article_id = $id;
        $like->user_id = Auth::id();
        $like->save();
        return redirect()->back();
    }   
    public function unlike($id)
    {
        $like = Like::where('article_id',$id)->where('user_id', Auth::id())->first();
        $like->delete(); 

        return redirect()->back();
    }
}
