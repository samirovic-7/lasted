<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MealsController extends Controller
{
    public function index()
    {
        $meals = Meal::with('meal_package')->get();

        return response()->json($meals);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'meal_code' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'name_loc' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'ledger_id' => 'required|exists:ledgers,id',
                'meal_package_id' => 'nullable|exists:meal_packages,id|array',

            ]);

            $meal = Meal::create([
                'meal_code' => $request->input('meal_code'),
                'name' => $request->input('name'),
                'name_loc' => $request->input('name_loc'),
                'price' => $request->input('price'),
                'ledger_id' => $request->input('ledger_id'),
            ]);
            $meal->meal_package()->sync($request->input('meal_package_id'));
            return response()->json($meal, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 400);
        }
    }

    public function show(Meal $meal)
    {

        return response()->json($meal);
    }

    public function update(Request $request, Meal $meal)
    {
        try {
            $request->validate([
                'meal_code' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'name_loc' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'ledger_id' => 'required|exists:ledgers,id',
                'meal_package_id' => 'nullable|exists:meal_packages,id|array',
            ]);
            $meal->meal_code = $request->input('meal_code');
            $meal->name = $request->input('name');
            $meal->name_loc = $request->input('name_loc');
            $meal->price = $request->input('price');
            $meal->ledger_id = $request->input('ledger_id');
            $meal->save();
            $meal->meal_package()->sync($request->input('meal_package_id'));
            return response()->json($meal);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 400);
        }
    }

    public function destroy(Meal $meal)
    {

        $meal->delete();

        return response()->json(['message' => 'Meal deleted']);
    }
}
