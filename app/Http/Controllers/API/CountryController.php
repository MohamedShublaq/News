<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        return response()->json([
            'status' => true ,
            'message' => 'Data of Country' ,
            'data' => $countries ,
        ]);
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
            'name' => 'required',
            'code' => 'required'
        ]);
        if(!$validator->fails()){
            $countries = new Country();
            $countries->name = $request->get('name');
            $countries->code = $request->get('code');
            $isSaved = $countries->save();
            return response()->json([
                'status' => true ,
                'message' => 'Created is Successfully',
            ] , 200);
        }
        else{
            return response()->json([
                'status' => false ,
                'message' => $validator->getMessageBag()->first(),
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
        $countries = Country::findOrFail($id);
        return response()->json([
            'status' => true ,
            'message' => 'Data of Country' ,
            'data' => $countries ,
        ]);
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
            'name' => 'nullable',
            'code' => 'nullable'
        ]);
        if(!$validator->fails()){
            $countries = Country::findOrFail($id);
            $countries->name = $request->get('name');
            $countries->code = $request->get('code');
            $isUpdated = $countries->save();
            return response()->json([
                'status' => true ,
                'message' => 'Updated is Successfully',
            ] , 200);
        }
        else{
            return response()->json([
                'status' => false ,
                'message' => $validator->getMessageBag()->first(),
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
        $countries = Country::destroy($id);
        return response()->json([
            'status' => true ,
            'message' => 'Deleted is Successfully',
        ] , 200);
    }
}