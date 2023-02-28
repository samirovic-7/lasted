<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Spatie\Activitylog\Facades\CauserResolver;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        

        return response()->json($categories);
    }


    public function store(CategoryRequest $request)
    {
       $category =  Category::create($request->validated());
     
        return response()->json($category);
    }

    public function show(Category $category) {
        return response()->json($category);
    }


    public function update(CategoryRequest $request, Category $category)
    {

        $category->update($request->validated());
       
        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
       
        return response()->json(['message' => 'Deleted Successfuly',
            'status' => true,
        ], 200);
    }
}
