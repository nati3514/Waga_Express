
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
    
