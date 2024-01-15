<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\banckend\Photo;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager; 
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;

class galleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // photo gallery
    public function photo()
    {
        $photos = Photo::all();
        return view('backend.gallery.photos', compact('photos'));
    }

        public function storePhoto(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif',
                'title' => 'required|string|max:255',
                'type'  => 'nullable|numeric|in:0,1',
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
    
            $imageFile = $request->file('photo');
            $save_url = $this->savePostImage($imageFile);
    
            Photo::create([
                'photo' => $save_url,
                'title' => $request->input('title'),
                'type'  => $request->input('type'),
            ]);
    
            $notification = ['photo_upload_message' => "New Photo Uploaded Successfully"];
            return redirect()->back()->with($notification);
        }
    
        private function savePostImage($imageFile)
        {
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $imageFile->getClientOriginalExtension();
            $img = $manager->read($imageFile);
            $img = $img->resize(370, 246);
            $img->toJpeg(80)->save(base_path('public/photo_gallery/' . $name_gen));
            return 'photo_gallery/' . $name_gen;
        }
    
    public function editPhoto($id)
     {
        $photos = Photo::find($id);
        return view('backend.gallery.editPhoto', compact('photos'));
     }

    public function destroyPhoto($id)
    {
        Photo::find($id)->delete();

        $notification = ['photo_delete_message' => "Photo Deleted Successfully"];
        return redirect()->back()->with($notification);
    }
}
