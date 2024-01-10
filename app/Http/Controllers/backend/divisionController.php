<?php

namespace App\Http\Controllers\backend;

use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class divisionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('backend.division.index');
    }

    public function divisionDataShow()
    {
        $divisions = Division::latest()->get();
        return response()->json([
           'divisions' => $divisions,
         ]);   
     }

    public function store(Request $request)
    {
        // dd('dsfsd');
        $validator = Validator::make($request->all(), [
            'add_modal_division_bn' => 'required|unique:divisions,division_bn|max:55',
            'add_modal_division_en' => 'required|unique:divisions,division_en|max:55',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{

            $division = new Division();
            $division->division_bn = $request->add_modal_division_bn ;
            $division->division_en = $request->add_modal_division_en ;
            $division->save();
       return redirect()->back()->with('new_division_insert_success', 'New Categroy Insert Sucessfully');
        }
    }

    public function edit($id)
    {
         $divisions = Division::find($id);
         return response()->json([
            'divisions' => $divisions,
          ]);  
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'division_bn' => 'required|unique:divisions|max:55',
            'division_en' => 'required|unique:divisions|max:55',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(), // Get the first error message
            ]);
        }else{
            $division = Division::find($id);
            $division->division_bn  =  $request->division_bn;
            $division->division_en  =  $request->division_en;
            $division->update();
            return response()->json([
                'status' => 200,
                'division_update' => 'Division Updated Successfully',
            ]);
        }
    
    }
    
    

    public function destroy($id)
    {
        Division::find($id)->delete();
        return redirect()->back()->with('division_delete_success', ' Categroy Delete Sucessfully');   
     }

}
