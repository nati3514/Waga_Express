<?php

namespace App\Http\Controllers;

use App\Models\branch;
use App\Models\StaffTransaction;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Notifications\depositNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;
class TranscationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function reports(Request $request){

        $user = Auth::user();
    


    //     dd($usersWithSameBranch);
// ->where('id

        If(Auth::user()->hasRole ('admin')){
        // dd($user->id);
        
        
        
       

    return view('admin.transaction.report', compact('data','data2'));
        }
        If(Auth::user()->hasRole ('cashier')){
            // dd($user->id);
             


           
           return view('admin.transaction.report', compact('data','data2'));

            }
            
    } 
public function index()
    {
        $user = Auth::user();
        
        $data = StaffTransaction::join('branches', 'branches.id', '=', 'staff_transactions.branch_id')
        ->where('staff_transactions.branch_id', $user->branch_Id)
        ->get();
        return view('admin.transaction.view_transcation',compact('data'));
    }
 public function transaction_history()
    {
        $user = Auth::user();
        If(Auth::user()->hasRole ('admin')){
        // dd($user->id);
        $data = Transaction::where('branch_id_fk', $user->branch_Id)->with('user')
       ->orderBy('created_at', 'desc')
       ->get();


        
        return view('admin.transaction.view_transcation_history', compact('data'));
        }
If(Auth::user()->hasRole ('cashier')){
            // dd($user->id);
            $data = Transaction::where('user_id_fk', $user->id)->with('user')
           ->orderBy('created_at', 'desc')
           ->get();
    
    
            
            return view('admin.transaction.view_transcation_history', compact('data'));
        }
    }
public function create()
    {
        //
    }
public function store(Request $request)
    {
        //
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
        //
    }
  public function destroy(string $id)
    {
        //
    }
