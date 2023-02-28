<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelRequest;
use App\Models\Label;

class LabelController extends Controller
{
    public function index()
    {
        $labels = Label::all();

        return response()->json($labels);
    }

    public function store(LabelRequest $request)
    {
        $label = Label::create($request->validated());

        return response()->json($label);
    }

    public function show(Label $label)
    {
        return response()->json($label);
    }
    public function update(LabelRequest $request, Label $label)
    {
        $label->update($request->validated());

        return response()->json($label);
    }

    public function destroy(Label $label)
    {
        $label->delete();

        return response()->json(['message' => 'Deleted Successfuly',
            'status' => true,
        ], 200);
    }
}
