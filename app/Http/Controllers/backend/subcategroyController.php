<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\banckend\Subcategory;

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
}
