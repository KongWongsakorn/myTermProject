<?php

namespace App\Http\Controllers;

use App\Models\ChatModel;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class SubcategoryController extends Controller
{

    public function showAllSubcategory(){

        $all_subcategory =Subcategory::all();
   
        return view('all-subcategory',compact('all_subcategory'));//return view('all-subcategory', compact('all_subcategory'));
        
    }

    public function addSubcategory(Request $request){
        // perform form validation here
        $validator = Validator::make($request->all(),[
            'name' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => $validator->errors()->toArray()]);
        }else{
            try {
                $addSubcategory = new Subcategory();
                $addSubcategory->name = $request->name;
                
                $addSubcategory->save();
                return response()->json(['success' => true, 'msg' => 'Subcategory added successfully']);
                
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'msg' => $e->getMessage()]);
            }
        }

    }

    // delete functionality
    public function deleteSubcategory($id){
        //DB::table('subcategorys')->where('id', '=', $id)->delete();
        

        try {
            $delete = Subcategory::where('id',$id)->delete();
            // if success print success msg
            return response()->json(['success' => true, 'msg' => 'Car Deleted Successfully']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    // edit functionality
    public function editSubcategory(Request $request){
        // validate form
        $validator = Validator::make($request->all(),[
            'name' => 'required',
          
        ]);
        if ($validator->fails()) {
            return response()->json(['msg' => $validator->errors()->toArray()]);
        }else{
            // perform edit functionality here
            try {
                Subcategory::where('id',$request->id)->update([
                    'name' => $request->name,
 
                ]);

                return response()->json(['success' => true, 'msg' => 'car updated successfully']);

            } catch (\Exception $e) {
                return response()->json(['success' => false, 'msg' => $e->getMessage()]);

            }
            
        }

    }
    
}