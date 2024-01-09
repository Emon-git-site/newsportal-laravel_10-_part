<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\banckend\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('backend.category.index');
    }

    public function categoryDataShow()
    {
        $categories = Category::all();

        return response()->json([
           'categories' => $categories,
         ]);   
     }

    public function store(Request $request)
    {
        $request->validate([
            'category_bn' => 'required|unique:categories|max:55',
            'category_en' => 'required|unique:categories|max:55',
        ]);
        
        Category::create($request->all());

        return redirect()->back()->with('new_category_insert_success', 'New Categroy Insert Sucessfully');
    }

    public function edit($id)
    {
         $categories = Category::find($id);
         return response()->json([
            'categories' => $categories,
          ]);  
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_bn' => 'required|unique:categories|max:55',
            'category_en' => 'required|unique:categories|max:55',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(), // Get the first error message
            ]);
        }else{
            $category = Category::find($id);
            $category->category_bn  =  $request->category_bn;
            $category->category_en  =  $request->category_en;
            $category->update();
            return response()->json([
                'status' => 200,
                'category_update' => 'Category Updated Successfully',
            ]);
        }
    
        // Continue with the update logic if validation passes
    }
    
    

    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->back()->with('category_delete_success', ' Categroy Delete Sucessfully');   
     }



}
