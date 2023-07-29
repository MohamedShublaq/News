<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\City;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::withCount('articles')->orderBy('id','desc')->paginate(10);
        return response()->view('cms.author.index' , compact('authors'));
    }
    public function recycle(){
        $authors = Author::orderBy('id','desc')->onlyTrashed()->paginate (10);
        return response()->view('cms.author.recycle', compact('authors'));
    }
    public function restore($id){
        $authors = Author::onlyTrashed()->findOrFail($id)->restore();
        $authors = Author::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.author.index', compact('authors'));
    }
    public function force($id){
        $authors = Author::onlyTrashed()->findOrFail($id)->forceDelete();
        $authors = Author::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.author.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        $specialities = Speciality::all();
        $roles = Role::where('guard_name' , 'author')->get();
        return response()->view('cms.author.create' , compact('cities' , 'specialities' , 'roles'));
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:authors,email',
        ]);
        if(! $validator->fails()){
            $authors = new Author();
            $authors->email = $request->get('email');
            $authors->password = Hash::make($request->get('password'));
            $isSaved = $authors->save();
            if($isSaved ){
                $users = new User();
                $roles = Role::findOrFail($request->get('role_id'));
                $authors->assignRole($roles->name);
                if (request()->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                    $image->move('storage/images/author', $imageName);
                    $users->image = $imageName;
                    }
                $users->first_name = $request->get('first_name');
                $users->last_name = $request->get('last_name');
                $users->gender = $request->get('gender');
                $users->status = $request->get('status');
                $users->date = $request->get('date');
                $users->mobile = $request->get('mobile');
                $users->city_id = $request->get('city_id');
                $users->speciality_id = $request->get('speciality_id');
                $users->actor()->associate($authors);
                $isSaved = $users->save();
                return response()->json([
                    'icon' => 'success',
                    'title' => 'Created is Successfully',
                ] , 200);
            }
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
        $cities = City::all();
        $specialities = Speciality::all();
        $authors = Author::findOrFail($id);
        return response()->view('cms.author.show' , compact('cities' , 'specialities' , 'authors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cities = City::all();
        $specialities = Speciality::all();
        $authors = Author::findOrFail($id);
        return response()->view('cms.author.edit' , compact('cities' , 'specialities' , 'authors'));
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
            'password' => 'nullable',
        ]);
        if(! $validator->fails()){
            $authors = Author::findOrFail($id);
            $authors->email = $request->get('email');
            $isSaved = $authors->save();
            if($isSaved ){
                $users = $authors->user;
                if (request()->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                    $image->move('storage/images/author', $imageName);
                    $users->image = $imageName;
                    }
                $users->first_name = $request->get('first_name');
                $users->last_name = $request->get('last_name');
                $users->gender = $request->get('gender');
                $users->status = $request->get('status');
                $users->date = $request->get('date');
                $users->mobile = $request->get('mobile');
                $users->city_id = $request->get('city_id');
                $users->speciality_id = $request->get('speciality_id');
                $users->actor()->associate($authors);
                $isUpdated = $users->save();
                return ['redirect' => route('authors.index')];
            }
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
        $authors = Author::destroy($id);
    }
}