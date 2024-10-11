<?php

namespace App\Http\Controllers;

use App\Models\Typeleave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class TypeleaveController extends Controller
{
    
    public function showAllTypeleave(){

        $all_typeleave =Typeleave::all();

        return view('all-typeleave',compact('all_typeleave'));//return view('all-subcategory', compact('all_subcategory'));
    }
    // edit functionality
    public function editTypeleave(Request $request){
        // validate form
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'number' => 'required|numeric|min:0',
          
        ]);
        if ($validator->fails()) {
            return response()->json(['msg' => $validator->errors()->toArray()]);
        }else{
            // perform edit functionality here
            try {
                Typeleave::where('id',$request->id)->update([
                    'name' => $request->name,
                    'number' => $request->number,
 
                ]);

                return response()->json(['success' => true, 'msg' => 'typeleave successfully']);

            } catch (\Exception $e) {
                return response()->json(['success' => false, 'msg' => $e->getMessage()]);

            }
            
        }

    }
}
