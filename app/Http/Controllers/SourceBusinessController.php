<?php

namespace App\Http\Controllers;

use App\Models\SourceBusiness;
use Illuminate\Http\Request;

class SourceBusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(SourceBusiness ::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'name'     => 'required|unique:businesses,name|max:254',
                'name_loc' => 'required|unique:businesses,name_loc|max:254',
            ]);
           
            $sourceBusiness= SourceBusiness::create($request->all());
            // dd($sourceBusiness);

            return response()->json([
                'message' => 'Source Of  Business  Created Successfully',
                'data'    =>  $sourceBusiness ,
            ], 201);

        }catch (ValidationException $e) {
            return response()->json([
                'message'   => 'Validation Error',
                'errors'    => $e->errors(),
            ], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SourceBusiness  $sourceBusiness
     * @return \Illuminate\Http\Response
     */
    public function show(SourceBusiness $sourceBusiness)
    {
       return response()->json($sourceBusiness->id::all());
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SourceBusiness  $sourceBusiness
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SourceBusiness $sourceBusiness,$id)
    {
        $request->validate([
            'name'      => 'required|unique:businesses,name|max:254',
            'name_loc'  => 'required|unique:businesses,name_loc|max:254',

       ]);
     

       $sourceBusiness= SourceBusiness::where('id',$id)->update([
           'name'     => $request->name,
           'name_loc' => $request->name_loc,
       ]);
       $sourceBusiness  = SourceBusiness::where('id', $id)->get();

       return response(['data' =>  $sourceBusiness ,
       'message' => 'Source Of  Business  Created Successfully',
    ], 200);
   }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SourceBusiness  $sourceBusiness
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sourceBusines=SourceBusiness::where('id',$id)->delete();
        return response()->json([
            'status'     => true,
            'message'    => 'Source Of  Business Deleted Successfully',
        ],201);
    }
    
}
