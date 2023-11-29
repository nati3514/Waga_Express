<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $data = User::join('branches','branches.id','=','users.branch_Id')
        ->where('users.id',$user->id)
        ->first();
        
        return view('admin.dashboard')->with('user_data', $data);
        
    }
    public function profile()
    {
        $user = Auth::user();
        $data = User::join('branches','branches.id','=','users.branch_Id')
        ->where('users.id',$user->id)
        ->first();
        return view('admin.profile')->with('user_data', $data);
    }

    public function fallback()
    {
        return view('admin.fallback');
    }
}
