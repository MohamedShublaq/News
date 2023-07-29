<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexArticle($authid)
    {
        $articles = Article::where('author_id', $authid)->orderBy('id' , 'desc')->paginate(10);
        return response()->view('cms.article.index', compact('articles','authid'));
    }
    public function createArticle($authid)
    {
        $authors = Author::all();
        $categories = Category::all();
        return response()->view('cms.article.create', compact('authid' , 'authors' ,'categories'));
    }
    public function index()
    {
        $articles = Article::orderBy('id','desc')->paginate(10);
        return response()->view('cms.article.indexAll' , compact('articles'));
    }
    public function recycle(){
        $articles = Article::orderBy('id','desc')->onlyTrashed()->paginate (10);
        return response()->view('cms.article.recycleAll', compact('articles'));
    }
    public function restore($id){
        $articles = Article::onlyTrashed()->findOrFail($id)->restore();
        $articles = Article::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.article.indexAll', compact('articles'));
    }
    public function force($id){
        $articles = Article::onlyTrashed()->findOrFail($id)->forceDelete();
        $articles = Article::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.article.indexAll', compact('articles'));
    }


    public function recycleArticle($authid){
        $articles = Article::orderBy('id','desc')->where('author_id' , $authid)->onlyTrashed()->paginate (10);
        return response()->view('cms.article.recycle', compact('articles' , 'authid'));
    }
    public function restoreArticle($id , $authid){
        $articles = Article::onlyTrashed()->where('author_id' , $authid)->findOrFail($id)->restore();
        $articles = Article::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.article.index', compact('articles' , 'authid'));
    }
    public function forceArticle($id , $authid){
        $articles = Article::onlyTrashed()->where('author_id' , $authid)->findOrFail($id)->forceDelete();
        $articles = Article::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.article.index', compact('articles' , 'authid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        return response()->view('cms.article.create' , compact('authors','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(),[
            'title' => 'required'
        ]);
        if(!$validator->fails()){
            $articles = new Article();
            if (request()->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                $image->move('storage/images/article', $imageName);
                $articles->image = $imageName;
                }
            $articles->title = $request->get('title');
            $articles->short_description = $request->get('short_description');
            $articles->full_description = $request->get('full_description');
            $articles->author_id = $request->get('author_id');
            $articles->category_id = $request->get('category_id');
            $isSaved = $articles->save();
            return response()->json([
                'icon' => 'success',
                'title' => 'Created is Successfully',
            ] , 200);
        }
        else{
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ] , 400);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articles = Article::findOrFail($id);
        $authors = Author::all();
        $categories = Category::all();
        return response()->view('cms.article.show' , compact('authors','categories','articles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articles = Article::findOrFail($id);
        $authors = Author::all();
        $categories = Category::all();
        return response()->view('cms.article.edit' , compact('authors','categories','articles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator($request->all(),[
            'title' => 'required'
        ]);
        if(!$validator->fails()){
            $articles = Article::findOrFail($id);
            if (request()->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                $image->move('storage/images/article', $imageName);
                $articles->image = $imageName;
                }
            $articles->title = $request->get('title');
            $articles->short_description = $request->get('short_description');
            $articles->full_description = $request->get('full_description');
            $articles->author_id = $request->get('author_id');
            $articles->category_id = $request->get('category_id');
            $isUpdated = $articles->save();
            return ['redirect' => route('articles.index')];
        }
        else{
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ] , 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articles = Article::destroy($id);
    }
}
