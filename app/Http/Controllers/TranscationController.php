<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TranscationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function reports(){

        $user = Auth::user();
    //     $usersWithSameBranch = User::where('branch_id', $user->branch_Id)
    // ->get(['first_name']);


    //     dd($usersWithSameBranch);

        If(Auth::user()->hasRole ('admin')){
        // dd($user->id);
        $data = Transaction::where('branch_id_fk', $user->branch_Id)->with('user')
       ->orderBy('created_at', 'desc')
       ->get();
        
       return view('admin.transaction.report', compact('data'));
        }
        If(Auth::user()->hasRole ('cashier')){
            // dd($user->id);
            $data = Transaction::where('user_id_fk', $user->id)->with('user')
           ->orderBy('created_at', 'desc')
           ->get();
    
    
            
           return view('admin.transaction.report', compact('data'));
            }
            return view('admin.transaction.report', compact('data'));
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