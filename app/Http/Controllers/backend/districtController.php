<?php

namespace App\Http\Controllers\backend;

use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class districtController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('backend.district.index');
    }


    public function districDataShow()
    {
        $districts = District::with('getDivision')->get();
        
        return response()->json([
            'districts' => $districts,
        ]);
    }


    public function store(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'district_en' => 'required|unique:districts|max:55',
            'district_bn' => 'required|unique:districts|max:55',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $district = new District();
            $district->district_bn  =  $request->district_bn;
            $district->district_en  =  $request->district_en;
            $district->division_id  =  $request->selectedDivision;
            $district->save();
            //  district::create($request->all());
            return redirect()->back()->with('new_district_insert_success', 'New District Insert Sucessfully');
        }
    }

    public function edit($id)
    {
        $districts = District::with('getDivision')->find($id);
        return response()->json([
            'districts' => $districts,
        ]);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'district_bn' => 'required|max:55',
            'district_en' => 'required|max:55',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(), // Get the first error message
            ]);
        } else {
            $district = District::find($id);
            $district->district_bn  =  $request->district_bn;
            $district->district_en  =  $request->district_en;
            $district->division_id  =  $request->division_id;
            $district->update();
            return response()->json([
                'status' => 200,
                'District_update' => 'District Updated Successfully',
            ]);
        }
    }


    public function destroy($id)
    {
        District::find($id)->delete();
        return redirect()->back()->with('district_delete_success', 'District Delete Sucessfully');   
     }
}
