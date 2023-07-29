<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id','desc')->paginate(10);
        return response()->view('cms.category.index' , compact('categories'));
    }

    public function recycle(){
        $categories = Category::onlyTrashed()->paginate (10);
        return response()->view('cms.category.recycle', compact('categories'));
    }
    public function restore($id){
        $categories = Category::onlyTrashed()->findOrFail($id)->restore();
        $categories = Category::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.category.index', compact('categories'));
    }
    public function force($id){
        $categories = Category::onlyTrashed()->findOrFail($id)->forceDelete();
        $categories = Category::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.category.index', compact('categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.category.create');
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
            'name' => 'required'
        ]);
        if(!$validator->fails()){
            $categories = new Category();
            $categories->name = $request->get('name');
            $categories->status = $request->get('status');
            $categories->description = $request->get('description');
            $isSaved = $categories->save();
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
        $categories = Category::findOrFail($id);
        return response()->view('cms.category.show' , compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::findOrFail($id);
        return response()->view('cms.category.edit' , compact('categories'));
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
            'name' => 'required'
        ]);
        if(!$validator->fails()){
            $categories = Category::findOrFail($id);
            $categories->name = $request->get('name');
            $categories->status = $request->get('status');
            $categories->description = $request->get('description');
            $isUpdated = $categories->save();
            return ['redirect' => route('categories.index')];
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
        $categories = Category::destroy($id);
    }
}