<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    //
    public function AddCategory(Request $request) {
        $validated = $request->validate([
            'category_name' => 'required'
        ]);

        Category::create($validated);
        return response()->json([
            "msg" => "Category Added"
        ], 201);
    }

    public function ListCategory() {

        $data =  Category::All();
        return response()->json([
            "data" => $data
        ], 201);
    }



    public function UpdateCategory(Request $request, $id)
    {
        $validated = $request->validate([
            'category_name' => 'required',
        ]);

        Category::where('id_category', $id)->update($validated);
        return response()->json([
            "msg" => "Category Updated"
        ], 201);
    }

    public function GetCategory($id)
    {
        $data = Category::find($id);

	    return response()->json([
	      'data' => $data
	    ], 201);
    }


    


}
