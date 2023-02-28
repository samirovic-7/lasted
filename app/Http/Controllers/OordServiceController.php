<?php

namespace App\Http\Controllers;

use App\Models\OordService;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OordServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(OordService::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        try{
            $request->validate([
                'room_id'                     =>'required|string|max:254',
                'oord_type'                   =>'required|in:OO,OS',
                'start_date'                  =>'required|date_format:Y/m/d',
                'end_date'                    =>'required|date_format:Y/m/d',
                'notes'                       =>'required',
                'created_by'                  =>'integer',
                'is_return'                   =>'boolean',
                'return_by'                   =>'integer',
                'return_date'                 =>'required|date_format:Y/m/d',
    
       ]);

      $oordService= new OordService();

        $oordService->room_id             =$request->room_id;
        $oordService->oord_type           =$request->oord_type;


        $hotelDate=2023/02/22;

        if($request->start_date != $hotelDate){
            $oordService->start_date =$request->start_date;

            $update_rooms= Room::find($id);
           $update_rooms-> update(['fo_status'=>"OO"

            ]);

        }else{
            $oordService->start_date =$request->start_date;
            $update_rooms= Room::find($id);
           $update_rooms-> update(['fo_status'=>"OO"

        ]);

        };
        $oordService->start_date          =$request->start_date;
        $oordService->end_date            =$request->end_date;
        $oordService->notes               =$request->notes;
        $oordService->created_by          =$request->created_by ;
        $oordService->is_return           =$request->is_return ;
        $oordService->return_by           =$request->return_by ;
        $oordService->return_date         =$request->return_date ;

        $oordService->save();

    
       return response()->json([
        'message'  => 'Order-Service Created Successfully',
        'data'     =>    $oordService,
    ], 201);
    
    } catch (ValidationException $e) {
    return response()->json([
        'message' => 'Validation Error',
        'errors'  => $e->errors(),
    ], 400);
    
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
        $oordService=OordService::find($id);
        return response()->json($oordService);

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
        $request->validate([
            'room_id'                    =>'required|string|max:254',
            'oord_type'                   =>'required|in:OO,OS',
            'start_date'                  =>'required|date_format:Y/m/d',
            'end_date'                    =>'required|date_format:Y/m/d',
            'notes'                       =>'required',
            'created_by'                  =>'integer',
            'is_return'                   =>'boolean',
            'return_by'                   =>'integer',
            'return_date'                 =>'required|date_format:Y/m/d',

   ]);

   $oordService = OordService::where('id',$id)->update([

    'room_id'                =>$request->room_id,
    'oord_type'              =>$request->oord_type,
    'start_date'             =>$request->start_date,
    'end_date'               =>$request->end_date,
    'notes'                  =>$request->notes,
    'created_by'             =>$request->created_by ,
    'is_return'              =>$request->is_return ,
    'return_by'              =>$request->return_by ,
    'return_date'           =>$request->return_date ,

   ]);
   $oordService = OordService::where('id',$id)->get();
   return response([

    'message'  => 'Order-Service Updated Successfully',
    'data'     => $oordService ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oordService =OordService ::where('id',$id)->delete();
        return response()->json([
            'status'     => true,
            'message'    => 'Order-Service  Deleted Successfully',
        ],201);
    }
}
