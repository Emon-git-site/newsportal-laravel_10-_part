<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\banckend\Category;
use App\Http\Controllers\Controller;
use App\Models\banckend\Subcategory;
use Illuminate\Support\Facades\Validator;

class subcategroyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('backend.subCategory.index');
    }


    public function subcategoryDataShow()
    {
        $subcategories = Subcategory::with('getCategory')->get();

        return response()->json([
            'subcategories' => $subcategories,
        ]);
    }


    public function store(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'subcategory_en' => 'required|unique:sub_categories|max:55',
            'subcategory_bn' => 'required|unique:sub_categories|max:55',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $subcategory = new Subcategory();
            $subcategory->subcategory_bn  =  $request->subcategory_bn;
            $subcategory->subcategory_en  =  $request->subcategory_en;
            $subcategory->category_id  =  $request->selectedCategory;
            $subcategory->save();
            //  Subcategory::create($request->all());
            return redirect()->back()->with('new_subcategory_insert_success', 'New SubCategroy Insert Sucessfully');
        }
    }

    public function edit($id)
    {
        $subcategories = Subcategory::with('getCategory')->find($id);
        return response()->json([
            'subcategories' => $subcategories,
        ]);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'subcategory_bn' => 'required|max:55',
            'subcategory_en' => 'required|max:55',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(), // Get the first error message
            ]);
        } else {
            $subcategory = Subcategory::find($id);
            $subcategory->subcategory_bn  =  $request->subcategory_bn;
            $subcategory->subcategory_en  =  $request->subcategory_en;
            $subcategory->category_id  =  $request->category_id;
            $subcategory->update();
            return response()->json([
                'status' => 200,
                'subcategory_update' => 'SubCategory Updated Successfully',
            ]);
        }
    }


    public function destroy($id)
    {
        Subcategory::find($id)->delete();
        return redirect()->back()->with('subcategory_delete_success', ' SubCategroy Delete Sucessfully');   
     }
}
