
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
public function show(string $id)
    {
        //
    }
public function edit(string $id)
    {
        //
    }
 public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id.'|max:50',
            'password' => 'required',
            'amount_limit' => 'required',
            'status' => 'required|in:active,deactive',
        ]);
        User::where('id', $id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'amount_limit' => $request->amount_limit,
            'status' => $request->status,
        ]);
        return redirect(route('staff.index'))->with('success', 'Updated successfully');
    }
public function limit(Request $request, string $id){
        $request->validate([
            'amount_limit' => 'required'
        ]);
        User::where('id', $id)->update([
            'amount_limit' => $request->amount_limit,
        ]);
        $user = User::where('id', $id)->first();
        Notification::send($user, new staffNotification($request->amount_limit,$user->first_name,$user->last_name));
        return redirect(route('staff.index'))->with('success', 'successfully updated');

    }
public function markasread($id){
        if($id){
            Auth::user()->unreadNotifications->where('id',$id)->markAsRead();
        }
        return back();
    }
public function printPreview(string $id){
        $data = DB::table('packages')
        ->join('customers as t1', 't1.id', '=', 'packages.sender_ID')
        ->join('customers as t2', 't2.id', '=', 'packages.receiver_ID')
        ->join('branches as t3', 't3.id', '=', 'packages.from_branch_id')
        ->join('branches as t4', 't4.id', '=', 'packages.to_branch_id')
        ->select(
            'packages.*',
            't1.name as sender_name',
            't1.phone as sender_phone',
            't1.city as sender_city',
            't3.branch_name as sender_branch',
            't2.name as receiver_name',
            't2.phone as receiver_phone',
            't2.city as receiver_city',
            't4.branch_name as receiver_branch'
        )
        ->where('packages.id', $id)
        // ->where('packages.status', 'collected') 
        ->first();
        // dd($data);
        $price = Transaction::where('package_id_fk', $data->id)->first();
        $weight = WeightPrice::where('id', $data->weight)->first();
            return view('admin.staff.print', compact('data','price','weight'));
    }
public function destroy(string $id)
    {
        User::where('id', $id)->update([
            'status' => 'inactive',
        ]);
        return redirect(route('staff.index'))->with('success', 'successfully deleted');
    }
   
}
