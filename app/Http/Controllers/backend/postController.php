<?php

namespace App\Http\Controllers\backend;

use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;
use App\Models\banckend\Category;
use App\Http\Controllers\Controller;
use App\Models\banckend\Subcategory;

class postController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getSubcategory($categoryId)
    {
        $subcategory = Subcategory::where('category_id', $categoryId)->get();
        return response()->json($subcategory);
    }
    public function getDistrict($division_id)
    {
        $district = District::where('division_id', $division_id)->get();
        return response()->json($district);
    }

    public function index()
    {
        $categories = Category::all();
        $divisions = Division::all();
        
        return view('backend/post/index', compact('categories', 'divisions'));
    }

    public function store(Request $request)
    {
        dd($request);
    }
}
