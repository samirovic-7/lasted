<?php

namespace App\Http\Controllers;

use App\Models\RateCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RateCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ratecode = RateCode::with('meal_package','meal','user','ledger','roomTypes')->get();

        return response()->json($ratecode);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            // Validate the request data
            $request->validate([
                'rate_code' => 'required|string|unique:rate_codes',
                'name' => 'required|string',
                'name_loc' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'active' => 'required|boolean',
                'meal_id' => 'nullable|prohibited_unless:meal_package_id,null|exists:meals,id',
                'meal_package_id' => 'nullable|prohibited_unless:meal_id,null|exists:meal_packages,id',
                'ledger_id' => 'required|exists:ledgers,id',
                'pax1' => 'required|numeric|min:0',
                'pax2' => 'required|numeric|min:0',
                'pax3' => 'required|numeric|min:0',
                'pax4' => 'required|numeric|min:0',
                'pax5' => 'required|numeric|min:0',
                'pax6' => 'required|numeric|min:0',
                'extra_pax' => 'required|numeric|min:0',
                'room_type_id' => 'array|required|exists:room_types,id',
            ]);

            $rateCode = RateCode::create([
                'rate_code' => $request->input('rate_code'),
                'name' => $request->input('name'),
                'name_loc' => $request->input('name_loc'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'active' => $request->input('active'),
                'meal_id' => $request->input('meal_id'),
                'meal_package_id' => $request->input('meal_package_id'),
                'ledger_id' => $request->input('ledger_id'),
                'user_id' => auth()->user()->id,
            ]);

            // Attach the room type to the rate code with pivot data
            $rateCode->roomTypes()->syncWithPivotValues($request->input('room_type_id'), [
                'pax1' => $request->input('pax1'),
                'pax2' => $request->input('pax2'),
                'pax3' => $request->input('pax3'),
                'pax4' => $request->input('pax4'),
                'pax5' => $request->input('pax5'),
                'pax6' => $request->input('pax6'),
                'extra_pax' => $request->input('extra_pax'),
            ]);

            return response()->json(['message' => 'Rate code created successfully.'], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RateCode  $rateCode
     * @return \Illuminate\Http\Response
     */
    public function show(RateCode $rateCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RateCode  $rateCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RateCode $rateCode)
    {
        try {

            // Validate the request data
            $request->validate([
                'rate_code' => 'required|string|unique:rate_codes,rate_code,'.$rateCode->id.',id',
                'name' => 'required|string',
                'name_loc' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'active' => 'required|boolean',
                'meal_id' => 'nullable|prohibited_unless:meal_package_id,null|exists:meals,id',
                'meal_package_id' => 'nullable|prohibited_unless:meal_id,null|exists:meal_packages,id',
                'ledger_id' => 'required|exists:ledgers,id',
                'pax1' => 'required|numeric|min:0',
                'pax2' => 'required|numeric|min:0',
                'pax3' => 'required|numeric|min:0',
                'pax4' => 'required|numeric|min:0',
                'pax5' => 'required|numeric|min:0',
                'pax6' => 'required|numeric|min:0',
                'extra_pax' => 'required|numeric|min:0',
                'room_type_id' => 'array|required|exists:room_types,id',
            ]);
            $rateCode->roomTypes()->syncWithPivotValues($request->input('room_type_id'), [
                'pax1' => $request->input('pax1'),
                'pax2' => $request->input('pax2'),
                'pax3' => $request->input('pax3'),
                'pax4' => $request->input('pax4'),
                'pax5' => $request->input('pax5'),
                'pax6' => $request->input('pax6'),
                'extra_pax' => $request->input('extra_pax'),
            ]);
            $rateCode->update([
                'rate_code' => $request->input('rate_code'),
                'name' => $request->input('name'),
                'name_loc' => $request->input('name_loc'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'active' => $request->input('active'),
                'meal_id' => $request->input('meal_id'),
                'meal_package_id' => $request->input('meal_package_id'),
                'ledger_id' => $request->input('ledger_id'),
                'user_id' => auth()->user()->id,
            ]);

            // Attach the room type to the rate code with pivot data
           

            return response()->json(['message' => 'Rate code updated successfully.'], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RateCode  $rateCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(RateCode $rateCode)
    {
        $rateCode->delete();
        return response()->json(['message' => 'Rate code deleted successfully.'], 201);
    }
}
