<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\package;



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
        $data = User::join('branches', 'branches.id', '=', 'users.branch_Id')
            ->where('users.id', $user->id)
            ->first();
            if ($data) {
                $countCollectedPackages = Package::where('from_branch_id', $data->branch_Id)
                    ->where(function ($query) use ($user) {
                        $query->orWhere('from_branch_id', $user->branch_Id);
                    })
                    ->where('status', 'collected')
                    ->count();
            }
            $countDeliveredPackages = Package::where('from_branch_id', $data->branch_Id)
             ->where(function ($query) use ($user) {
                 $query->orWhere('from_branch_id', $user->branch_Id);
             })
             ->where('status', 'delivered')
             ->count();
             $totalCountPackages = Package::where('from_branch_id', $data->branch_Id)
             ->where(function ($query) use ($user) {
                 $query->orWhere('from_branch_id', $user->branch_Id);
             })
             ->count();
            // dd($countCollectedPackages);
        return view('admin.dashboard')->with('user_data', $data)
        ->with('count_collected_packages', $countCollectedPackages)
        ->with('count_delivered_packages', $countDeliveredPackages)
        ->with('total_packages', $totalCountPackages);
        
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
