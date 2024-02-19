<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;


class LikeController extends Controller
{
    public function like(Request $request)
    {
        $user_id = Auth::id();
        $article_id = $request->article_id;
        $already_liked = Like::where('user_id', $user_id)->where('article_id', $article_id)->first();

        if (!$already_liked) {
            $like = new Like;
            $like->article_id = $article_id;
            $like->user_id = $user_id;
            $like->save();
        } else {
            Like::where('article_id', $article_id)->where('user_id', $user_id)->delete();
        }

        $article = Article::where('id', $article_id)->first();
        $article_likes_count = $article->likes->count();
        $param = [
            'likes_count' => $article_likes_count,
        ];
        return response()->json($param);
    }
    /*public function like($id,Like $like)
    {
        $like->article_id = $id;
        $like->user_id = Auth::id();
        $like->save();
        return redirect()->back();
    }*/
    /*public function unlike($id)
    {
        $like = Like::where('article_id',$id)->where('user_id', Auth::id())->first();
        $like->delete(); 

        return redirect()->back();
    }*/
}
