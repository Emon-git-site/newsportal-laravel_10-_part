<?php

namespace App\Http\Controllers\backend;

use App\Models\banckend\Seo;
use Illuminate\Http\Request;
use App\Models\banckend\Namaz;
use App\Models\banckend\livetv;
use App\Models\banckend\Notice;
use App\Models\banckend\Social;
use App\Models\banckend\Website;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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
    // end namaz setting

    // live tv setting
    public function livetvSetting()
    {
        $livetv = livetv::first();
        return view('backend.setting.livetv', compact('livetv')); 
    }
    public function updatelivetv(Request $request, $id)
    {
        $livetv = livetv::find($id);
        $livetv->update($request->all());

        $notification = ['livetv_update_message' => "LiveTV Updated Successfully"];
        return Redirect()->back()->with($notification);
    }

    public function activeLivetv($id)
    {
        $livetv = livetv::find($id);
        $livetv->update(['status' =>1]);
        $notification = ['livetv_active_message' => "LiveTV Activate Successfully"];
        return Redirect()->back()->with($notification);
    }
    public function deactiveLivetv($id)
    {
        $livetv = livetv::find($id);
        $livetv->update(['status' =>0]);
        $notification = ['livetv_deactive_message' => "LiveTV DeActivate Successfully"];
        return Redirect()->back()->with($notification);
    }
    // end  live tv setting 

    // notice setting
    public function noticeSetting()
    {
        $notice = Notice::first();
        return view('backend.setting.notice', compact('notice')); 
    } 
    public function updatenotice(Request $request, $id)
    {
        $notice = Notice::find($id);
        $notice->update($request->all());

        $notification = ['notice_update_message' => "notice Updated Successfully"];
        return Redirect()->back()->with($notification);
    }

    public function activenotice($id)
    {
        $notice = Notice::find($id);
        $notice->update(['status' =>1]);
        $notification = ['notice_active_message' => "notice Activate Successfully"];
        return Redirect()->back()->with($notification);
    }
    public function deactivenotice($id)
    {
        $notice = Notice::find($id);
        $notice->update(['status' =>0]);
        $notification = ['notice_deactive_message' => "notice DeActivate Successfully"];
        return Redirect()->back()->with($notification);
    }
    // end notice setting

    // important website
    public function websiteSetting()
    {
        return view('backend.setting.website'); 
    } 

    public function websiteDataShow()
    {
        $websites = Website::latest()->get();
        return response()->json([
           'websites' => $websites,
         ]);   
     }

    public function store(Request $request)
    {
        Website::create($request->all());
        $notification = ['new_website_insert_message' => "New Website Inserted Successfully"];
        return Redirect()->back()->with($notification);
    }


    public function edit($id)
    {
         $website = Website::find($id);
         return response()->json([
            'website' => $website,
          ]);  
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'website_name' => 'required|max:55',
            'website_link' => 'required|max:55',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(), // Get the first error message
            ]);
        }else{
            $website = Website::find($id);
            $website->website_name  =  $request->website_name;
            $website->website_link  =  $request->website_link;
            $website->update();
            return response()->json([
                'status' => 200,
                'website_update' => 'Website Updated Successfully',
            ]);
        }
    }

    public function destroy($id)
    {
        Website::find($id)->delete();
        $notification = ['website_delete_message' => " Website Deleted Successfully"];
        return Redirect()->back()->with($notification);
    }
}
