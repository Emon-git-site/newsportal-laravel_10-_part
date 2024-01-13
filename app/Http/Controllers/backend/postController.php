<?php

namespace App\Http\Controllers\backend;

use App\Models\banckend\Post;
use App\Models\banckend\District;
use App\Models\banckend\Division;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use App\Models\banckend\Category;
use App\Http\Controllers\Controller;
use App\Models\banckend\Subcategory;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;

class postController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  // for ajax request
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
  // end ajax request

  public function index()
  {
    $posts = Post::class::with('getCategory', 'getSubcategory')->get();
    return view('backend.post.index', compact('posts'));
  }

  public function create()
  {
    $categories = Category::all();
    $divisions = Division::all();

    return view('backend/post/create', compact('categories', 'divisions'));
  }

  public function store(Request $request)
  {
      $validator = Validator::make($request->all(), [
          'category_id' => 'required|integer',
          'subcategory_id' => 'required|integer',
          'division_id' => 'required|integer',
          'district_id' => 'required|integer',
          'title_bn' => 'required|string',
          'title_en' => 'required|string',
          'image' => 'required|image|mimes:jpeg,png,jpg,gif',
          'details_en' => 'nullable|string',
          'details_bn' => 'required|string',
          'tags_bn' => 'required|string',
          'tags_en' => 'nullable|string',
          'headline' => 'nullable|integer',
          'first_section' => 'nullable|integer',
          'first_section_thumbnail' => 'nullable|integer',
          'bigthumbnail' => 'nullable|integer',
      ]);
  
      if ($validator->fails()) {
          return redirect()->back()->withErrors($validator);
      }
  
      $post = new Post($request->except('image'));
      $post->user_id = Auth::user()->id;
      $post->category_id = $request->category_id;
      $post->subcategory_id = $request->subcategory_id;
      $post->division_id = $request->division_id;
      $post->district_id = $request->district_id;
      $post->user_id = Auth::user()->id;
      $post->title_bn = $request->title_bn;
      $post->title_en = $request->title_en;
      $post->details_en = $request->details_en;
      $post->details_bn = $request->details_bn;
      $post->tag_bn = $request->tags_bn;
      $post->tag_en = $request->tags_en;
      $post->headline = $request->headline;
      $post->first_section = $request->first_section;
      $post->first_section_thumbnail = $request->first_section_thumbnail;
      $post->bigthumbnail = $request->bigthumbnail;
  
      $imageFile = $request->file('image');
      $save_url = $this->savePostImage($imageFile);
  
      $post->image = $save_url;
      $post->save();
  
      $notification = ['post_insert_message' => 'Post Inserted Successfully'];
      return redirect()->back()->with($notification);
  }
  
  private function savePostImage( $imageFile)
  {
      $manager = new ImageManager(new Driver());
      $name_gen = hexdec(uniqid()) . '.' . $imageFile->getClientOriginalExtension();
      $img = $manager->read($imageFile);
      $img = $img->resize(370, 246);
      $img->toJpeg(80)->save(base_path('public/post_image/' . $name_gen));
      return 'post_image/' . $name_gen;
  }

  public function edit($id)
  {
    $categories = Category::all();
    $divisions = Division::all();
    $post = Post::find($id);
    return view('backend.post.edit', compact('post','categories', 'divisions'));
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'category_id' => 'required|integer',
      'subcategory_id' => 'required|integer',
      'division_id' => 'required|integer',
      'district_id' => 'required|integer',
      'title_bn' => 'required|string',
      'title_en' => 'required|string',
      'details_en' => 'nullable|string',
      'details_bn' => 'required|string',
      'tags_bn' => 'required|string',
      'tags_en' => 'nullable|string',
      'headline' => 'nullable|integer',
      'first_section' => 'nullable|integer',
      'first_section_thumbnail' => 'nullable|integer',
      'bigthumbnail' => 'nullable|integer',
      // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator);
    } else {
      if($request->file('image')){

  
        $post = Post::find($id);
        $post->category_id = $request->category_id;
        $post->subcategory_id = $request->subcategory_id;
        $post->division_id = $request->division_id;
        $post->district_id = $request->district_id;
        $post->title_bn = $request->title_bn;
        $post->title_en = $request->title_en;
        $post->details_en = $request->details_en;
        $post->details_bn = $request->details_bn;
        $post->tag_bn = $request->tags_bn;
        $post->tag_en = $request->tags_en;
        $post->headline = $request->headline;
        $post->first_section = $request->first_section;
        $post->first_section_thumbnail = $request->first_section_thumbnail;
        $post->bigthumbnail = $request->bigthumbnail;

        unlink($post->image);
        $manager = new ImageManager(new Driver());
        $name_gen = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
        $img = $manager->read($request->file('image'));
        $img = $img->resize(370, 246);
  
        $img->toJpeg(80)->save(base_path('public/post_image/' . $name_gen));
        $save_url = 'post_image/' . $name_gen;

        $post->image = $save_url;
        $post->update();
  
        $notification = ['post_updated_message' => 'Post Updated Successfully'];
        return redirect()->back()->with($notification);
      }else{

        $post = Post::find($id);
        $post->category_id = $request->category_id;
        $post->subcategory_id = $request->subcategory_id;
        $post->division_id = $request->division_id;
        $post->district_id = $request->district_id;
        $post->title_bn = $request->title_bn;
        $post->title_en = $request->title_en;
        $post->details_en = $request->details_en;
        $post->details_bn = $request->details_bn;
        $post->tag_bn = $request->tags_bn;
        $post->tag_en = $request->tags_en;
        $post->headline = $request->headline;
        $post->first_section = $request->first_section;
        $post->first_section_thumbnail = $request->first_section_thumbnail;
        $post->bigthumbnail = $request->bigthumbnail;
        $post->update();
  
        $notification = ['post_updated_message' => 'Post Updated Successfully'];
        return redirect()->back()->with($notification);
      }
    }
  }
  

  public function destroy($id)
  {
    $post = Post::find($id);
    if($post){
      unlink($post->image);
      $post->delete();
      return redirect()->back()->with('post_delete_success', "post deleted Successfully");
    }else{
      return redirect()->back()->with('post_delete_fail', 'Post Delete Failed.');
    }
  }
}
