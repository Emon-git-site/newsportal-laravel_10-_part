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
         ])->header('Cache-Control', 'no-cache, no-store, must-revalidate')
         ->header('Pragma', 'no-cache')
         ->header('Expires', '0');   
     }


     public function edit($id)
     {
        $subcategories = Subcategory::with('getCategory')->find($id);        
        //   $subcategories = Subcategory::find($id);
          return response()->json([
             'subcategories' => $subcategories,
           ]);  
     }
}
