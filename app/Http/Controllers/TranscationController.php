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
