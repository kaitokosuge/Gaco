<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Article $article,Category $category)
    {
        return view('article/index')->with(['articles'=>$article->get(),'categories' => $category->get()]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        return view('article/create')->with(['categories' => $category->get()]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Article $article)
    {
        $article->user_id = \Auth::user()->id;
        $input = $request['article'];
        $article->fill($input)->save();

        if(!is_null($request->categories_array)){
            $categories = $request->categories_array;
            $article->categories()->attach($categories);
        }
        return redirect()->route('index.article');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article,Comment $comment,Category $category)
    {
        return view('article/show')->with(['article' => $article,'comment' => $comment,'category' =>$category->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('article/edit')->with(['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article->user_id = \Auth::user()->id;
        $input = $request['article'];
        $article->fill($input)->save();
        return redirect()->route('show.article',['article' => $article->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('index.article');
    }
}
