<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Staff access|Staff add|Staff edit|Staff delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Staff add', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Staff edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Staff delete', ['only' => ['destroy']]);
        
    }
    
    
    public function index()
    {
        $user = Auth::user();
        $data = User::where('branch_Id',$user->branch_Id)->role('cashier')->get();
        return view('admin.staff.view_all_staff',compact('data'));  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $branch = User::join('branches','branches.id','=','users.branch_Id')
        ->where('users.id',$user->id)
        ->first();
    return view('admin.staff.create_staff', compact('branch'));  
    }


   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'from_branch' => 'required',
            'email' => 'required|email|unique:users,email|max:50',
            'password' => 'required',
            'amount_limit' => 'required',
        ]);
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'branch_Id' => $request->from_branch,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'amount_limit' => $request->amount_limit,
        ]);
        $user->syncRoles('cashier');
        return redirect(route('staff.index'))->with('success', 'Staff successfully added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id.'|max:50',
            'password' => 'required',
            'amount_limit' => 'required',
        ]);
        User::where('id', $id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'amount_limit' => $request->amount_limit,
        ]);
        return redirect(route('staff.index'))->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return redirect(route('staff.index'))->with('success', 'successfully deleted');
    }
}
