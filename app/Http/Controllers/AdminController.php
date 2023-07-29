<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\City;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::orderBy('id','desc')->paginate(10);
        $this->authorize('viewAny' , Admin::class);
        return response()->view('cms.admin.index' , compact('admins'));
    }

    public function recycle(){
        $admins = Admin::orderBy('id','desc')->onlyTrashed()->paginate (10);
        return response()->view('cms.admin.recycle', compact('admins'));
    }
    public function restore($id){
        $admins = Admin::onlyTrashed()->findOrFail($id)->restore();
        $admins = Admin::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.admin.index', compact('admins'));
    }
    public function force($id){
        $admins = Admin::onlyTrashed()->findOrFail($id)->forceDelete();
        $admins = Admin::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.admin.index', compact('admins'));
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
        $roles = Role::where('guard_name' , 'admin')->get();
        $this->authorize('create' , Admin::class);
        return response()->view('cms.admin.create' , compact('cities' , 'specialities' , 'roles'));
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
            'email' => 'required|unique:admins,email',
        ]);
        if(! $validator->fails()){
            $admins = new Admin();
            $admins->email = $request->get('email');
            $admins->password = Hash::make($request->get('password'));
            $isSaved = $admins->save();
            if($isSaved ){
                $users = new User();
                $roles = Role::findOrFail($request->get('role_id'));
                $admins->assignRole($roles->name);
                if (request()->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                    $image->move('storage/images/admin', $imageName);
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
                $users->actor()->associate($admins);
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
        $admins = Admin::findOrFail($id);
        $this->authorize('view' , Admin::class);
        return response()->view('cms.admin.show' , compact('cities' , 'specialities' , 'admins'));
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
        $admins = Admin::findOrFail($id);
        $this->authorize('update' , Admin::class);
        return response()->view('cms.admin.edit' , compact('cities' , 'specialities' , 'admins'));
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
            $admins = Admin::findOrFail($id);
            $admins->email = $request->get('email');
            $isSaved = $admins->save();
            if($isSaved ){
                $users = $admins->user;
                if (request()->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                    $image->move('storage/images/admin', $imageName);
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
                $users->actor()->associate($admins);
                $isUpdated = $users->save();
                return ['redirect' => route('admins.index')];
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
        $admins = Admin::destroy($id);
    }
}