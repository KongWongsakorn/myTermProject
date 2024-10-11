<?php

namespace App\Http\Controllers;

use App\Models\Leaveofabsence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\TypeLeave;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class CrudController extends Controller
{
    //
    public function showAllLeaveofabsences()
    {
        $user = Auth::user();
        
        $all_leaveofabsences = Leaveofabsence::orderBy('id', 'desc')
            ->where('u_approver', $user->id)
            ->paginate(7); 
    
        return view('all-leaveofabsences', compact('all_leaveofabsences', 'user'));
    }
    
   
    public function editLeave(Request $request){
        $validator = Validator::make($request->all(),[            
            'status' => 'required',
        ]);
        
        if($validator->fails()){
            return response()->json(['msg' => $validator->errors()->toArray()]);
        }else{
            try {
                Leaveofabsence::where('id',$request->Leave_id)->update([                
                    'status' =>$request->status,
                ]); 
                return response()->json(['success' => true, 'msg' =>'Leave Update successfully']);

            } catch (\Exception $e) {
                return response()->json(['success' => false, 'msg' =>$e->getMessage()]);
                
            }            
        }
    }
    function detail($id)
{
    $detail = Leaveofabsence::find($id);
    return view('detailLeave', compact('detail'));
}

public function search(Request $request)
{
    $search = $request->get('search');
    $userId = auth()->user()->id;

    $all_leaveofabsences  = Leaveofabsence::where('u_approver', $userId)
        ->where(function ($query) use ($search, $userId) {
            $query->where('firstDate', 'like', "%$search%")
                ->orWhere('endDate', 'like', "%$search%")
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->where('firstname', 'like', "%$search%")
                        ->orWhere('lastname', 'like', "%$search%");
                })
                ->orWhereHas('userapprover', function ($query) use ($search, $userId) {
                    $query->where('firstname', 'like', "%$search%")
                        ->orWhere('lastname', 'like', "%$search%")
                        ->where('u_approver', $userId);
                })
                ->orWhere('status', 'like', "%$search%")
                ->orWhereHas('typeLeave', function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                });
        })->paginate(7);

    return view('all-leaveofabsences', compact('all_leaveofabsences'));
}


    public function boot(): void{
        Paginator::useBootstrap();
    }
   
 
}
