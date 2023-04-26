<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use Cloudinary;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Article $article,Category $category,Request $request)
    {
        $search = $request->input('search');
        $category_id = $request->input('category_id');

        if($search){
            $spaceConversion = mb_convert_kana($search, 's');
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            $query = Article::query()->get();
            foreach($wordArraySearched as $value) {
                $query->where('title', 'like', '%'.$value.'%')
                        ->orwhere('explanation', 'like', '%'.$value.'%')
                        ->orwhere('html', 'like', '%'.$value.'%')
                        ->orwhere('css', 'like', '%'.$value.'%')
                        ->orwhere('js', 'like', '%'.$value.'%');
            }
            $articles = $query->orderBy('created_at', 'desc')->getPaginateByLimit(3);
        } elseif(!($category_id == null)) {
            $articles = $category->find($category_id)->articles->sortByDesc('updated_at')->paginate(3);
        } else {
            $articles = $article->getPaginateByLimit(3);
        }

        
        return view('article/index')->with(['articles'=>$articles,'categories' => $category->get(), 'search' => $search]);
        
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
        //dd($request);
        $article->user_id = \Auth::user()->id;
        $input = $request['article'];
        
        $image = $request->file('image');
        if(isset($image)){
            $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            //dd($image_url);
            $article->image = $image_url;
        } else {
            $article->image = "https://res.cloudinary.com/ddsv7l0eq/image/upload/v1679331981/u2dypdmcpilo1unzoxpa.jpg";
        }


        $article->fill($input)->save();
        //dd($image_url);
        
        
        /*if(isset($request["images_array"])){
            foreach($request->file("images_array") as $image){
                //new_imageに格納していく
                $new_image = New Image;
                //カラム参照,ID参照
                $new_image->system_id = $system->id;
                //クラウディナリー専用メソッドget~
                $new_image->image_url = Cloudinary::upload($image->getRealPath())->getSecurePath();
                //dd(Cloudinary::upload($image->getRealPath())->getSecurePath());
                $new_image->save();
            }
        }*/

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
    public function edit(Article $article,Category $category)
    {
        return view('article/edit')->with(['article' => $article,'categories' => $category->get()]);
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
        if(!is_null($request->categories_array)){
            $categories = $request->categories_array;
            $article->categories()->attach($categories);
        }
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
