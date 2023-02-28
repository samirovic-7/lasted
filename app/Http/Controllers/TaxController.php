<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Tax::all());
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
            $request->validate([
                'name' => 'required|string|max:255',
                'name_loc' => 'required|string|max:255',
                'per' => 'required_without:amount|numeric|nullable|prohibited_unless:amount,null',
                'amount' => 'required_without:per|numeric|nullable|prohibited_unless:per,null',
                'formula' => 'nullable|string',
                'extra' => 'nullable|string',
                'accept_per' => 'required|boolean',
            ]);

            $tax = Tax::create($request->only([
                'name', 'name_loc', 'per', 'amount', 'formula', 'extra', 'accept_per',
            ]));

            return response()->json([
                'message' => 'Tax created successfully',
                'tax' => $tax,
            ], 201);

        } catch (\Exception$e) {
            return response()->json([
                'message' => 'Failed to create tax',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function show(Tax $tax)
    {
        
        try {
            return response()->json($tax);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Tax not found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tax $tax)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'name_loc' => 'required|string|max:255',
                'per' => 'required_without:amount|numeric|nullable|prohibited_unless:amount,null',
                'amount' => 'required_without:per|numeric|nullable|prohibited_unless:per,null',
                'formula' => 'nullable|string',
                'extra' => 'nullable|string',
                'accept_per' => 'required|boolean',
            ]);

            $tax->update($request->only([
                'name', 'name_loc', 'per', 'amount', 'formula', 'extra', 'accept_per',
            ]));

            return response()->json([
                'message' => 'Tax updated successfully',
            ], 201);

        } catch (\Exception$e) {
            return response()->json([
                'message' => 'Failed to update tax',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tax $tax)
    {
        $tax->delete();
        return response()->json([
            'message' => 'Tax deleted successfully',
        ], 201);
    }
}
