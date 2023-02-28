<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LedgerController extends Controller
{

    public function index()
    {
        return response()->json(Ledger::all());
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'code' => 'required|integer',
                'name' => 'required|string|max:255',
                'name_loc' => 'required|string|max:255',
                'type' => 'required|string',
                'ledger_cat_id' => 'required|exists:ledger_cats,id',
                'inctaxes' => 'array|nullable',
                'taxes' => 'array|nullable',
            ]);

            $ledger = Ledger::create($request->all());

            $ledger->inctaxes()->syncWithPivotValues($request->inctaxes, ['inc' => true]);

            $ledger->taxes()->syncWithPivotValues($request->taxes, ['inc' => false]);

            return response()->json([
                'message' => 'Ledger created successfully',
                'data' => $ledger,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 400);
        }
    }
    public function show(Ledger $ledger)
    {
        $ledgerdetails = Ledger::where('id', $ledger->id)->with('inctaxes','taxes')->get();
        return response()->json($ledgerdetails);
    }
    public function update(Request $request, Ledger $ledger)
    {
        try {
            $request->validate([
                'code' => 'required|integer',
                'name' => 'required|string|max:255',
                'name_loc' => 'required|string|max:255',
                'type' => 'required|string',
                'ledger_cat_id' => 'required|exists:ledger_cats,id',
                'inctaxes' => 'array|nullable',
                'taxes' => 'array|nullable',
            ]);

            $ledger->update($request->all());

            $ledger->inctaxes()->syncWithPivotValues($request->inctaxes, ['inc' => true]);

            $ledger->taxes()->syncWithPivotValues($request->taxes, ['inc' => false]);

            return response()->json([
                'message' => 'Ledger updated successfully',
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 400);
        }
    }
    public function destroy(Ledger $ledger)
    {
        $ledger->delete();
        return response()->json([
            'message' => 'Ledger deleted successfully',
        ], 201);
    }

}
