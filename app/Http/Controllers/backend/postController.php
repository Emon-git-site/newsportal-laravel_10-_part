<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\banckend\Category;
use App\Models\Division;
use Illuminate\Http\Request;

class postController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::all();
        $divisions = Division::all();
        
        return view('backend/post/index', compact('categories', 'divisions'));
    }
}
