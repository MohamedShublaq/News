<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Viewer;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::orderBy('id','desc')->paginate(10);
        return response()->view('cms.comment.index' , compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $articles = Article::all();
        // $viewers = Viewer::all();
        // return response()->view('cms.comment.create', compact('articles' , 'viewers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validator = Validator($request->all(),[
        //     'comment' => 'required'
        // ]);
        // if(!$validator->fails()){
        //     $comments = new Comment();
        //     $comments->comment = $request->get('comment');
        //     $comments->article_id = $request->get('article_id');
        //     $comments->viewer_id = $request->get('viewer_id');
        //     $isSaved = $comments->save();
        //     return response()->json([
        //         'icon' => 'success',
        //         'title' => 'Created is Successfully',
        //     ] , 200);
        // }
        // else{
        //     return response()->json([
        //         'icon' => 'error',
        //         'title' => $validator->getMessageBag()->first(),
        //     ] , 400);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $comments = Comment::findOrFail($id);
        // $articles = Article::all();
        // $viewers = Viewer::all();
        // return response()->view('cms.comment.show', compact('articles' , 'viewers' , 'comments'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $comments = Comment::findOrFail($id);
        // $articles = Article::all();
        // $viewers = Viewer::all();
        // return response()->view('cms.comment.edit', compact('articles' , 'viewers' , 'comments'));
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
        // $validator = Validator($request->all(),[
        //     'comment' => 'required'
        // ]);
        // if(!$validator->fails()){
        //     $comments = Comment::findOrFail($id);
        //     $comments->comment = $request->get('comment');
        //     $comments->article_id = $request->get('article_id');
        //     $comments->viewer_id = $request->get('viewer_id');
        //     $isUpdated = $comments->save();
        //     return ['redirect' => route('comments.index')];
        // }
        // else{
        //     return response()->json([
        //         'icon' => 'error',
        //         'title' => $validator->getMessageBag()->first(),
        //     ] , 400);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comments = Comment::destroy($id);
    }
}
