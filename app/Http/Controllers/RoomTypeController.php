<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{

    public function index()
    {

        return response()->json(RoomType::all());

    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'rm_type_code' => 'required|string|max:20',
                'rm_type_name' => 'required|string|max:255',
                'rm_type_name_loc' => 'required|string|max:255',
                'def_pax' => 'required|integer',
                'def_price' => 'required|numeric',
                'no_of_rooms' => 'required|integer',
                'rm_type_rentable' => 'required|boolean',
                'sort_order' => 'required|integer',
                'scth_type_code' => 'required|integer',
                'def_rate_code' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException$e) {
            return response()->json($e->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $roomtype = RoomType::create([
            'rm_type_code' => $request->rm_type_code,
            'rm_type_name' => $request->rm_type_name,
            'rm_type_name_loc' => $request->rm_type_name_loc,
            'def_pax' => $request->def_pax,
            'def_price' => $request->def_price,
            'no_of_rooms' => $request->no_of_rooms,
            'rm_type_rentable' => $request->rm_type_rentable,
            'sort_order' => $request->sort_order,
            'scth_type_code' => $request->scth_type_code,
            'def_rate_code' => $request->def_rate_code,
        ]);
        return response()->json($roomtype);
    }

    public function show(RoomType $roomType)
    {
        return response()->json($roomType);
    }

    public function update(Request $request, RoomType $roomType)
    {
        try {
            $request->validate([
                'rm_type_code' => 'required|string|max:20',
                'rm_type_name' => 'required|string|max:255',
                'rm_type_name_loc' => 'required|string|max:255',
                'def_pax' => 'required|integer',
                'def_price' => 'required|numeric',
                'no_of_rooms' => 'required|integer',
                'rm_type_rentable' => 'required|boolean',
                'sort_order' => 'required|integer',
                'scth_type_code' => 'required|integer',
                'def_rate_code' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException$e) {
            return response()->json($e->errors(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
        $status = $roomType->update([
            'rm_type_code' => $request->rm_type_code,
            'rm_type_name' => $request->rm_type_name,
            'rm_type_name_loc' => $request->rm_type_name_loc,
            'def_pax' => $request->def_pax,
            'def_price' => $request->def_price,
            'no_of_rooms' => $request->no_of_rooms,
            'rm_type_rentable' => $request->rm_type_rentable,
            'sort_order' => $request->sort_order,
            'scth_type_code' => $request->scth_type_code,
            'def_rate_code' => $request->def_rate_code,
        ]);
        return response()->json($status);
    }

    public function destroy(RoomType $roomType)
    {
        $roomType->delete();
        return response()->json("deleted");
    }
}
