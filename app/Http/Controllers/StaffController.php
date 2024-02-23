
<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\WeightPrice;
use App\Notifications\staffNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
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
        $data = User::where('branch_Id',$user->branch_Id)->whereIn('status', ['active', 'deactive'])->role('cashier')->get();
        return view('admin.staff.view_all_staff',compact('data'));  
    }
 public function create()
    {
        $user = Auth::user();
        $branch = User::join('branches','branches.id','=','users.branch_Id')
        ->where('users.id',$user->id)
        ->first();
    return view('admin.staff.create_staff', compact('branch'));  
    }
public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'from_branch' => 'required',
            'email' => 'required|email|unique:users,email|max:50',
            'password' => 'required',
            'amount_limit' => 'required',
            'status' => 'required|in:active,deactive', 
        ]);
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'branch_Id' => $request->from_branch,
            'email' => $request->email,
            'status' => $request->status,
            'password' => bcrypt($request->password),
            'amount_limit' => $request->amount_limit,
        ]);
        $user->syncRoles('cashier');
        return redirect(route('staff.index'))->with('success', 'Staff successfully added');
    }
