<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acknowledge;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use App\Models\Leaveofabsence;

class AcknowledgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Acknowledge = Acknowledge::where('status', '=', 'อนุมัติ')->paginate(5);

        return view('acknowledge.index', compact('Acknowledge'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        // Acknowledge::index($request->all());

        // return redirect()->route('acknowledge.index')->with('success', 'Leave has acknowledged');
        return view('acknowledge');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Acknowledge = Acknowledge::findOrFail($id);

        return view('acknowledge.show', compact('Acknowledge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function acknowledge($id)
    {
        $Acknowledge = Acknowledge::find($id);
        $Acknowledge->acknowledge='รับทราบ';
        $Acknowledge->save();

        // return redirect()->back();
        return redirect()->back()->with('success', 'Leave has acknowledged');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $Acknowledge = Acknowledge::where('firstDate', 'like', "%$search%")->where('status','=','อนุมัติ')
        ->orWhere('endDate', 'like', "%$search%")->where('status','=','อนุมัติ')
        ->orWhereHas('user', function ($query) use ($search) {
            $query->where('firstname', 'like', "%$search%")->where('status','=','อนุมัติ')
                ->orWhere('lastname', 'like', "%$search%")->where('status','=','อนุมัติ');
        })
        ->orWhereHas('userapprover', function ($query) use ($search){
            $query->where('firstname', 'like', "%$search%")->where('status','=','อนุมัติ')
                ->orWhere('lastname', 'like', "%$search%")->where('status','=','อนุมัติ');
        })
        ->orWhereHas('typeLeave', function ($query) use ($search) {
            $query->where('name', 'like', "%$search%")->where('status','=','อนุมัติ');
        })->paginate(7);
        return view('acknowledge.index', compact('Acknowledge'));
    }

    function download($id)
    {
        $id = Acknowledge::find($id)->first;
        return response()->download(public_path('$id->file'));
    }

    public function showAllLeaveofabsences()
    {
        $user = Auth::user();

        $all_leaveofabsences = Leaveofabsence::orderBy('id', 'desc')
            ->where('u_approver', $user->id)
            ->paginate(7); 

        return view('acknowledge.index', compact('Acknowledge'));
    }
    public function boot(): void{
        Paginator::useBootstrap();
    }
}
