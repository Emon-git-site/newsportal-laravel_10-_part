<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\banckend\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class settingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function socialSetting()
    {
        $social = Social::first();
        return view('backend.setting.social', compact('social')); 
    }

    public function updateSocial(Request $request, $id)
    {
        $social = Social::find($id);
        $social->update($request->all());

        $notification = ['social_update_message' => "Social Link Updated Successfully"];
        return Redirect()->back()->with($notification);
    }
}
