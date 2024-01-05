<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TranscationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function reports(Request $request){

        $user = Auth::user();
    //     $usersWithSameBranch = User::where('branch_id', $user->branch_Id)
    // ->get(['first_name']);


    //     dd($usersWithSameBranch);

            // ->where('id','<>',$user->id)
            $fromDate = Carbon::parse($request->from);
            $toDate = Carbon::parse($request->to)->endOfDay();

        If(Auth::user()->hasRole ('admin')){
        // dd($user->id);
        $data = Transaction::where('branch_id_fk', $user->branch_Id)->when($request->select_user != null, 
        function ($query) use ($request){
            return $query->where('user_id_fk', $request->select_user);
        })
        ->whereBetween('created_at', [ $fromDate,  $toDate])
        ->with('user')
       ->orderBy('created_at', 'desc')
       ->get();
        
       //     $data = Transaction::where('branch_id_fk', $user->branch_Id)->where('user_id_fk', $request->select_user)
    //     ->whereBetween('created_at', [ $fromDate,  $toDate])
    //     ->with('user')
    //    ->orderBy('created_at', 'desc')
    //    ->get();
    $data2 = ModelsUser::where('branch_Id', $user->branch_Id)->get();
    return view('admin.transaction.report', compact('data','data2'));
        }
        If(Auth::user()->hasRole ('cashier')){
            // dd($user->id);
            $data = Transaction::where('user_id_fk', $request->user)
            ->whereBetween('created_at', [ $fromDate,  $toDate])
            ->with('user')
           ->orderBy('created_at', 'desc')
           ->get(); 


           $data2 = ModelsUser::where('id', $user->id)->first();
           return view('admin.transaction.report', compact('data','data2'));

            }
            
    } 
     public function index()
    {
        
        $data = User::all();
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
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}