<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Floor::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
                'floor_name'       =>'required',
                'floor_name_loc'   =>'required',
                'active'           =>'required',
                'no_of_rooms'      =>'required',
                'sort_order'       =>'required',
        ]);

//        if($request->validate->fails()){
//            return response()->json([
//                'status'  => false,
//                'message' => 'Error In Validation',
//                'errors'  =>$request->validate ->errors(),
//            ], 401);
//        }

        Floor::create([
            'floor_name'         => $request->floor_name,
            'floor_name_loc'     => $request->floor_name_loc,
            'active'             => $request->active,
            'no_of_rooms'        => $request->no_of_rooms,
            'sort_order'         => $request->sort_order,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Created Successfully',
        ], 401);
    
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function show(Floor $floor)
    {

        return response()->json(Floor::all());
    }
    //     $floorTrashed = Floor::onlyTrashed()->get();
    //    if($floorTrashed){
    //         return $floorTrashed;
    //    }else{
    //         return null;
    // }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Floor $floor)
    {
        $request->validate([
            'floor_name'       =>'required',
            'floor_name_loc'   =>'required',
            'active'           =>'required|active',
            'no_of_rooms'      =>'required',
            'sort_order'       =>'required',
    ]);
    if($request->validate->fails()){
        return response()->json([
            'status'  => false,
            'message' => 'Error In Validation',
            'errors'  =>$request->validate ->errors(),
        ], 401);
    }

    Floor::update([
        'floor_name'         => $request->floor_name,
        'floor_name_loc'     => $request->floor_name_loc,
        'active'             => $request->active,
        'no_of_rooms'        => $request->no_of_rooms,
        'sort_order'         => $request->sort_data,  
    ]);
    return response()->json([
        'status' => true,
        'message' => 'Updated Successfully',
    ], 401);
}
public function restoreTrashed($id)
{
    $floorTrashed = Floor::where('id', $id)->onlyTrashed()->get();
    if ($floorTrashed) {
        $floorRestored = Floor::withTrashed()->where('id', $id)->restore();
        
        return $floorTrashed;
    } else {
        return null;
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $floor=Floor::find($id);
        if($floor){

          $floor->delete();
           // return $floor;
        }else{
            return null;
        }
    }
    public function delete($id)
    {
        $floor=Floor::find($id);
        if($floor){
            $floor>delete();
            return $floor;
        }else{
            return null;
        }
    }

}
