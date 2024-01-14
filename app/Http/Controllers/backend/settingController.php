<?php

namespace App\Http\Controllers\backend;

use App\Models\banckend\Seo;
use Illuminate\Http\Request;
use App\Models\banckend\Social;
use App\Http\Controllers\Controller;
use App\Models\banckend\Namaz;
use Illuminate\Support\Facades\Redirect;

class settingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // social setting 
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
    // end social settiing
    
    // seo setting
    public function seoSetting()
    {
        $seo = Seo::first();
        return view('backend.setting.seo', compact('seo')); 
    }

    public function updateSeo(Request $request, $id)
    {
        $seo = Seo::find($id);
        $seo->update($request->all());

        $notification = ['seo_update_message' => "Seo Updated Successfully"];
        return Redirect()->back()->with($notification);
    }
    // end seo setting

    // namaz setting
    public function namazSetting()
    {
        $namaz = Namaz::first();
        return view('backend.setting.namaz', compact('namaz')); 
    }
    public function updatenamaz(Request $request, $id)
    {
        $namaz = Namaz::find($id);
        $namaz->update($request->all());

        $notification = ['namaz_update_message' => "Namaz Updated Successfully"];
        return Redirect()->back()->with($notification);
    }
}
