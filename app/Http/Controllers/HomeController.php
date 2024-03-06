
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\package;
use App\Models\Transaction;
use Illuminate\Support\Carbon;



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
        
        $data = User::join('branches', 'branches.id', '=', 'users.branch_Id')
            ->where('users.id', $user->id)
            ->first();
            
        If(Auth::user()->hasRole ('admin')) {
            if ($data) {
                $dataId = $data->id;


                $currentDate = Carbon::now()->format('Y-m-d');

                $totalPrice = Transaction::where(function ($query) use ($user, $dataId) {
                    $query->where('branch_id_fk', $dataId)
                          ->orWhere('branch_id_fk', $user->branch_Id);
                    })
                    ->whereDate('created_at', $currentDate)
                    ->where('status', 'collected')
                    ->sum('price');       
                // dd($totalPrice);
                $countCollectedPackages = Package::where('from_branch_id', $data->branch_Id)
                    ->where(function ($query) use ($user) {
                        $query->orWhere('from_branch_id', $user->branch_Id);
                    })
                    ->where('status', 'collected')
                    ->count();
                $countReceivedPackages = Package::where('to_branch_id', $data->branch_Id)
                    ->where(function ($query) use ($user) {
                        $query->orWhere('to_branch_id', $user->branch_Id);
                    })
                    ->where('status', 'received')
                    ->count();

                $countPackages = $countCollectedPackages + $countReceivedPackages;
                    // dd($countPackages);
                    

                    $leatestTrancation = Transaction::where('branch_id_fk', $user->branch_Id)->with('user')
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();
            }

            
        }
        If(Auth::user()->hasRole ('cashier')) {
            if ($data) {
                $dataId = $data->id;


                $currentDate = Carbon::now()->format('Y-m-d');

                $totalPrice = Transaction::where(function ($query) use ($user, $dataId) {
                    $query->where('branch_id_fk', $dataId)
                          ->orWhere('branch_id_fk', $user->branch_Id);
                    })
                    ->where('user_id_fk', $user->id) // Additional condition for the authenticated user
                    ->whereDate('created_at', $currentDate)
                    ->sum('price');       
                // dd($totalPrice);
                $countCollectedPackages = Package::where('from_branch_id', $data->branch_Id)
                    ->where(function ($query) use ($user) {
                        $query->orWhere('from_branch_id', $user->branch_Id);
                    })
                    ->whereIn('status', ['collected', 'received'])
                    ->count();

                $leatestTrancation = Transaction::where('user_id_fk', $user->id)->with('user')
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();

                    
                $countCollectedPackages = Package::where('from_branch_id', $data->branch_Id)
                    ->where(function ($query) use ($user) {
                        $query->orWhere('from_branch_id', $user->branch_Id);
                    })
                    ->where('status', 'collected')
                    ->count();
                $countReceivedPackages = Package::where('to_branch_id', $data->branch_Id)
                    ->where(function ($query) use ($user) {
                        $query->orWhere('to_branch_id', $user->branch_Id);
                    })
                    ->where('status', 'received')
                    ->count();

                $countPackages = $countCollectedPackages + $countReceivedPackages;
                    // dd($countPackages);
            }
}
            $countDeliveredPackages = Package::where('to_branch_id', $data->branch_Id)
             ->where(function ($query) use ($user) {
                 $query->orWhere('to_branch_id', $user->branch_Id);
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
        ->with('count_collected_packages', $countPackages)
        ->with('count_delivered_packages', $countDeliveredPackages)
        ->with('total_packages', $totalCountPackages)
        ->with('total_price', $totalPrice)
        ->with('Leatest_Trancation', $leatestTrancation);
        
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
