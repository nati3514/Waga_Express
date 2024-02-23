<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\customer;
use App\Models\package;
use App\Models\branch;
use App\Models\PackageCategory;
use App\Models\Product;
use App\Models\User;
use App\Models\WeightPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Transaction;
use App\Models\Percent;
use Twilio\Rest\Client;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function received_package(){
        $user = Auth::user();
        // dd($user->branch_Id);

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
    ->where('t4.id', $user->branch_Id) // Filter by to_branch_id matching the authenticated user's branch
    ->orderBy('packages.created_at', 'desc')
    ->get();
    
    
        return view('admin.received_package_list',compact('data'));
    }

    public function delivered_package(){
        $user = Auth::user();
        // dd($user->branch_Id);

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
    ->where('t4.id', $user->branch_Id) // Filter by to_branch_id matching the authenticated user's branch
    ->orderBy('packages.created_at', 'desc')
    ->get();
    
    
        return view('admin.delivered_package_list',compact('data'));
    }
    public function receivePackage(Request $request)
{
    $user = Auth::user();
    $packageTag = $request->input('package_tag');
    $branchID = User::join('branches', 'branches.id', '=', 'users.branch_Id')
            ->where('users.id', $user->id)
            ->first();
 
            // Fetch the updated package information
            $packageInfo = Package::where('package_tag', $packageTag)->first();

            // Check if the package exists
    if (!$packageInfo) {
        return back()->with('error', 'Package does not exist.');
    }

    // Check if the package has already been received
    if ($packageInfo->status == 'received') {
        return back()->with('error', 'You already added this package.');
    }
            
        
            // Retrieve the percentage of delivery for calculating the commission
        $percentDelivered = Percent::select('percent')->where('status', 'received')->first();
        $percentDelivered = Percent::where('status','received')->first();
        // dd($percentDelivered->percent);
        // Retrieve the transaction price associated with the package
        $price = Transaction::where('package_id_fk', $packageInfo->id)->first();
        // dd($price->price);ssss
    
        // Check if the package is intended for the current branch of the authenticated user
        if ($packageInfo->to_branch_id == $branchID->branch_Id) {
            // Retrieve the current balance of the destination branch
            $branchBalance = Branch::where('id', $packageInfo->to_branch_id)->first();
            

            $deduct_amount = 0;
            
            $com_amount = ($price->price * (($percentDelivered->percent) / 100));
    
            // Calculate the total balance after adding the commission
            $total = $branchBalance->balance + ($price->price * (($percentDelivered->percent) / 100));
            // dd($tot);
    
            $transaction = Transaction::create([
                'branch_id_fk' => $branchID->branch_Id,
                'package_id_fk' => $packageInfo->id,
                'user_id_fk' => $user->id,
                'status' => $percentDelivered->status,
                'percent' => $percentDelivered->percent,
                'price' => $price->price,
                'Ded_amount' => $deduct_amount,
                'commission' => $com_amount,
                'current_balance' => $total,

                
            ]);
            // dd($transaction);
            
            // Update the balance of the destination branch
            $totalCommission = Branch::where('id', $packageInfo->to_branch_id)->update([
                'balance' => $total,
            ]);
    
            // Update the status of the package to 'delivered'
            Package::where('id', $packageInfo->id)->update([
                'status' => 'received',
            ]);
        
                // Fetch all received packages based on the provided conditions
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
                    ->where('t4.id', $branchID->branch_Id) // Filter by receiver's branch
                    ->where('packages.status', 'received')
                    ->orderBy('packages.created_at', 'desc')
                    ->get();
        
                    // Check if the collection is not empty before trying to access the property
                    // if (!$data->isEmpty()) {
                    //     // Access the receiver_phone property of the first item in the collection
                    //     $receiver_phone = $data->first()->receiver_phone;
                    //     $name = $data->first()->receiver_name;
                    //     $branch = $data->first()->receiver_branch;
                    
                        
                        
                    //     $price = $request->price;
                    //     // Format the phone number as "+251 98 666 4047"
                    //     $formatted_receiver_phone = sprintf(
                    //         "+251 %s %s %s",
                    //         substr($receiver_phone, 0, 2),
                    //         substr($receiver_phone, 2, 3),
                    //         substr($receiver_phone, 5)
                    //     );
                        
                    //     $sid = getenv("TWILIO_SID"); 
                    //     $token = getenv("TWILIO_TOKEN");
                    //     $receivernumber = getenv("TWILIO_PHONE");
                    //     $twilio = new Client($sid, $token);
                
                    // $message = $twilio->messages->create(
                    //     $formatted_receiver_phone, // to
                    //     [
                    //         "body" => "Hello $name. Welcome to WagaExpress! Your package has arrived from our $branch. Please come and collect your package. Thank you for choosing WagaExpress!",
                    //         "from" => $receivernumber
                    //     ]
                    // );
                
                    //     // dd("message send successfully");
                    // }
                return view('admin.received_package_list', compact('packageInfo','data'))->with('success', 'Package received successfully.');

                
   

        return redirect(route('products.index'))->with('error', 'error ');
            } else {
                // If the package is not intended for the current branch, show an error message
                return back()->with('error', 'You cannot receive this package');
            }
        
}


    public function index()
    {
        $user = Auth::user();
    
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
            ->where(function ($query) use ($user) {
                $query->Where('t3.id', $user->branch_Id); // Filter by sender's branch
            })
            ->where('packages.status', 'collected') 
            ->orderBy('packages.created_at', 'desc')
            ->get();
    
        $receiversBranch = DB::table('branches')->get();
    
        return view('admin.view_all_products', compact('data', 'receiversBranch'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $firstBranch = User::join('branches','branches.id','=','users.branch_Id')
        ->where('users.id',$user->id)
        ->first();
        $data= DB::table('branches')->get();
        // dd($data);
        // $firstBranch = DB::table('branches')->first();
        $receiversBranch = DB::table('branches')->where('id','<>',$firstBranch->id)->get();
        // $countries = Country::all();
        $weight = WeightPrice::all();
       // return view('admin.dashboard',compact('data', 'firstBranch','receiversBranch','weight'));
       $customers_phone_no = DB::table('customers')->get();
        return view('admin.create_product', compact('data', 'firstBranch', 'receiversBranch', 'weight','customers_phone_no'));
        // ->with(['dashboardViewData' => $firstBranch]);

    
    }

//     public function createProduct()
// {
//     $user = Auth::user();
//     $firstBranch = User::join('branches','branches.id','=','users.branch_Id')
//         ->where('users.id',$user->id)
//         ->first();
//     $data= DB::table('branches')->get();

//     return view('admin.dashboard', compact('data', 'firstBranch'));
// }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
            // dd($request->to_branch);
            $data= $request->validate([
                'sender_name' => 'required',
                'sender_phone' => 'required|digits:9',
                'from_branch' => 'required',
                'sender_city' => 'required',
                'receiver_name' => 'required',
                'receiver_phone' => 'required|digits:9',
                'to_branch' => 'required',
                'receiver_city' => 'required',
                // 'from_to' => 'required',
                'package_type' => 'required',
                'weight' => 'required',
                'status' => 'required',
                'package_tag' => 'required|unique:packages,package_tag',
               
            ]);

            $price = $request->price;
            $user = Auth::user();
            $amountLimit = $user->amount_limit;
            // dd($amountLimit);
            $senderBranch = User::join('branches','branches.id','=','users.branch_Id')
            ->where('users.id',$user->id)
            ->first();

            If(Auth::user()->hasRole ('admin')) {
                $senderBranchId = $senderBranch->id;
        
                // Retrieve commission values from the transactions table
                $transactions = Transaction::where('branch_id_fk', $senderBranchId)
                    ->where(function ($query) use ($user) {
                        $query->orWhere('branch_id_fk', $user->branch_Id);
                    })
                    ->get();

            $percentCollected = Percent::where('status','collected')->first();
            // dd($percentCollected->status);
            // $percentDelivered = Percent::select('percent')->where('status','delivered')->first();
            $branchBalance = $senderBranch->balance;
            //dd($percentCollected->percent);
            $deduct_amount = ($price * ((100 - $percentCollected->percent)/100));
            
            $com_amount = ($price * (($percentCollected->percent)/100));
            $total = $branchBalance - ($price * ((100 - $percentCollected->percent)/100));
            if($total < 0){
                return back()->with('error', 'Insufficient balance'); 
            }
            $senderInfo = customer::firstOrCreate(
                ['phone' => $request->sender_phone],
                [
                    'name' => $request->sender_name,
                    'city' => $request->sender_city,
                ]
            
            );
            $receiverInfo = customer::firstOrCreate(
                ['phone' => $request->receiver_phone],
                [
                    'name' => $request->receiver_name,
                    'city' => $request->receiver_city,
                ]
            );
       
            $package = package::create([
                'package_tag' => $request->input('package_tag'),
                'package_type' => $request->package_type,
                'sender_ID' => $senderInfo->id,
                'receiver_ID' => $receiverInfo->id,
                'status' => $request->status,
                'from_branch_id' => $request->from_branch,
                'to_branch_id' => $request->to_branch,
                'weight' => $request->weight,
            ]);

            

            
           
            
            $transaction = Transaction::create([
                'branch_id_fk' => $request->from_branch,
                'package_id_fk' => $package->id,
                'user_id_fk' => $user->id,
                'status' => $percentCollected->status,
                'percent' => $percentCollected->percent,
                'price' => $request->price,
                'Ded_amount' => $deduct_amount,
                'commission' => $com_amount,
                'current_balance' => $total,
            ]);

            // Count the number of transactions associated with the authenticated user's branch
          $transactionCount = Transaction::where('branch_id_fk', $user->branch_Id)
             ->count();
          // Count the number of packages where status is 'collected'
          $collectedPackageCount = package::where('status', 'collected')->count();
          $deliveredPackageCount = package::where('status', 'delivered')->count();
          // dd($collectedPackageCount);
            // Retrieve commission values again including the new transaction
        $transactions = Transaction::where('branch_id_fk', $senderBranchId)
        ->where(function ($query) use ($user) {
            $query->orWhere('branch_id_fk', $user->branch_Id);
        })
        ->get();

            // Calculate the sum of commission values
            $totalCommission = $transactions->sum('commission');

            branch::where('id',$senderBranch->branch_Id)->update([
                'balance' => $total,
                'Tot_commission' => $totalCommission,
                'Tot_package' => $transactionCount,
                // 'package_on_hand' => $collectedPackageCount,
                // 'delivered' => $deliveredPackageCount,
            ]);
    //     $sender_phone = $request->sender_phone;
    //     $branch=$senderBranch->branch_name;
    //     $price = $request->price;
    //     // Format the phone number as "+251 98 666 4047"
    //     $formatted_sender_phone = sprintf(
    //         "+251 %s %s %s",
    //         substr($sender_phone, 0, 2),
    //         substr($sender_phone, 2, 3),
    //         substr($sender_phone, 5)
    //     );
        
    //     $sid = getenv("TWILIO_SID"); 
    //     $token = getenv("TWILIO_TOKEN");
    //     $sendernumber = getenv("TWILIO_PHONE");
    //     $twilio = new Client($sid, $token);

    // $message = $twilio->messages->create(
    //     $formatted_sender_phone, // to
    //     [
    //         "body" => "Welcome to WagaExpress Your package is collected from $branch. You paid $price ETB. Thank You for using WagaExpress",
    //         "from" => $sendernumber
    //     ]
    // );
    $sender_phone = $request->sender_phone;
    $sender_name = $request->sender_name;
$branch = $senderBranch->branch_name;
$price = $request->price;

// Format the phone number as "+251 98 666 4047"
$formatted_sender_phone = sprintf(
    "+251 %s %s %s",
    substr($sender_phone, 0, 2),
    substr($sender_phone, 2, 3),
    substr($sender_phone, 5)
);

// AfroMessage API details
$token = 'eyJhbGciOiJIUzI1NiJ9.eyJpZGVudGlmaWVyIjoic0dtY2YyZ1djUXcxNlZCNWpFZXp2ZVRCNTBmbG44QVIiLCJleHAiOjE4NjUzMzU1NDMsImlhdCI6MTcwNzQ4Mjc0MywianRpIjoiNDhmMmUzMDAtNzQzNy00ODdjLWFmNWMtNjEyYWViOGY3MWRmIn0.OTXEYxyGZ95haDdJSGlH2BlgBIecfNB16F3ypvN8cEE';
$from = 'e80ad9d8-adf3-463f-80f4-7c4b39f7f164';
$sender = 'WagaExpress';
$to = $formatted_sender_phone; // Assuming AfroMessage requires the phone number in this format
$message = "Dear $sender_name, \nWelcome to WagaExpress Your package is Collected from $branch. You paid $price ETB. Thank You for using WagaExpress.";
// $callback = 'YOUR_CALLBACK_URL';

// AfroMessage API endpoint
$url = 'https://api.afromessage.com/api/send';

// Request body
$body = [
    "from" => $from,
    "sender" => $sender,
    "to" => $to,
    "message" => $message,
    // "callback" => $callback
];

// Configure cURL request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));

// Request headers
$headers = [
    'Authorization: Bearer ' . $token,
    'Content-Type: application/json',
];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Send request
$result = curl_exec($ch);

// Handle response
if (curl_errno($ch)) {
    // General HTTP error
    echo 'Error: ' . curl_error($ch);
} else {
    // Check HTTP code
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    switch ($http_code) {
        case 200:
            // Inspect `acknowledge` node and see if the response is an error or success
            $data = json_decode($result, true);
            if ($data['acknowledge'] == 'success') {
                echo "Api success";
            } else {
                echo "Api failure";
            }
            break;
        default:
            // Other API error, mostly authorization-related. Inspect the response body for details.
            echo 'Other HTTP Code: ' . $http_code;
    }
}

// Finish
curl_close($ch);

// dd($data);


            return redirect(route('products.index'))->with('success', 'Registration successfull');
        }

        If(Auth::user()->hasRole ('cashier')) {
            $senderBranchId = $senderBranch->id;
    
            // Retrieve commission values from the transactions table
            $transactions = Transaction::where('branch_id_fk', $senderBranchId)
                ->where(function ($query) use ($user) {
                    $query->orWhere('branch_id_fk', $user->branch_Id);
                })
                ->get();

                $currentDate = Carbon::now()->format('Y-m-d');

                // Retrieve the sum of the price column from transactions for the current day
                $totalPrice = Transaction::where(function ($query) use ($user, $senderBranchId) {
                        $query->where('branch_id_fk', $senderBranchId)
                              ->orWhere('branch_id_fk', $user->branch_Id);
                    })
                    ->where('user_id_fk', $user->id) // Additional condition for the authenticated user
                    ->whereDate('created_at', $currentDate)
                    ->sum('price');

            // dd($totalPrice);     
            // dd($amountLimit);
        $current_total_price = $totalPrice + $price;
        // dd($current_total_price);
        $percentCollected = Percent::where('status','collected')->first();
        // dd($percentCollected->status);
        // $percentDelivered = Percent::select('percent')->where('status','delivered')->first();
        $branchBalance = $senderBranch->balance;
        //dd($percentCollected->percent);
        $deduct_amount = ($price * ((100 - $percentCollected->percent)/100));
        
        $com_amount = ($price * (($percentCollected->percent)/100));
        $total = $branchBalance - ($price * ((100 - $percentCollected->percent)/100));
        // dd($total);
        // dd($current_total_price < $amountLimit);
        
        if( $total > 0  && $current_total_price < $amountLimit ){
            $senderInfo = customer::firstOrCreate(
                ['phone' => $request->sender_phone],
                [
                    'name' => $request->sender_name,
                    'city' => $request->sender_city,
                ]
            
            );
            $receiverInfo = customer::firstOrCreate(
                ['phone' => $request->receiver_phone],
                [
                    'name' => $request->receiver_name,
                    'city' => $request->receiver_city,
                ]
            );
       
            $package = package::create([
                'package_tag' => $request->input('package_tag'),
                'package_type' => $request->package_type,
                'sender_ID' => $senderInfo->id,
                'receiver_ID' => $receiverInfo->id,
                'status' => $request->status,
                'from_branch_id' => $request->from_branch,
                'to_branch_id' => $request->to_branch,
                'weight' => $request->weight,
            ]);
    
            
    
            
           
            
            $transaction = Transaction::create([
                'branch_id_fk' => $request->from_branch,
                'package_id_fk' => $package->id,
                'user_id_fk' => $user->id,
                'status' => $percentCollected->status,
                'percent' => $percentCollected->percent,
                'price' => $request->price,
                'Ded_amount' => $deduct_amount,
                'commission' => $com_amount,
                'current_balance' => $total,
            ]);
    
            // Count the number of transactions associated with the authenticated user's branch
          $transactionCount = Transaction::where('branch_id_fk', $user->branch_Id)
             ->count();
          // Count the number of packages where status is 'collected'
          $collectedPackageCount = package::where('status', 'collected')->count();
          $deliveredPackageCount = package::where('status', 'delivered')->count();
          // dd($collectedPackageCount);
            // Retrieve commission values again including the new transaction
        $transactions = Transaction::where('branch_id_fk', $senderBranchId)
        ->where(function ($query) use ($user) {
            $query->orWhere('branch_id_fk', $user->branch_Id);
        })
        ->get();
    
            // Calculate the sum of commission values
            $totalCommission = $transactions->sum('commission');
    
            branch::where('id',$senderBranch->branch_Id)->update([
                'balance' => $total,
                'Tot_commission' => $totalCommission,
                'Tot_package' => $transactionCount,
                // 'package_on_hand' => $collectedPackageCount,
                // 'delivered' => $deliveredPackageCount,
            ]);
    
        //     $sender_phone = $request->sender_phone;
        //     $branch=$senderBranch->branch_name;
        //     $price = $request->price;
        //     // Format the phone number as "+251 98 666 4047"
        //     $formatted_sender_phone = sprintf(
        //         "+251 %s %s %s",
        //         substr($sender_phone, 0, 2),
        //         substr($sender_phone, 2, 3),
        //         substr($sender_phone, 5)
        //     );
            
        //     $sid = getenv("TWILIO_SID"); 
        //     $token = getenv("TWILIO_TOKEN");
        //     $sendernumber = getenv("TWILIO_PHONE");
        //     $twilio = new Client($sid, $token);
    
        // $message = $twilio->messages->create(
        //     $formatted_sender_phone, // to
        //     [
        //         "body" => "Welcome to WagaExpress Your package is collected from $branch. You paid $price ETB. Thank You for using WagaExpress",
        //         "from" => $sendernumber
        //     ]
        // );

            return redirect(route('products.index'))->with('success', 'Registration successfull');
           
        }
        return back()->with('error', 'Insufficient balance'); 
        
    }

        $sender_phone = $request->sender_phone;
        $branch=$senderBranch->branch_name;
        $price = $request->price;
        // Format the phone number as "+251 98 666 4047"
        $formatted_sender_phone = sprintf(
            "+251 %s %s %s",
            substr($sender_phone, 0, 2),
            substr($sender_phone, 2, 3),
            substr($sender_phone, 5)
        );
        
        $sid = getenv("TWILIO_SID"); 
        $token = getenv("TWILIO_TOKEN");
        $sendernumber = getenv("TWILIO_PHONE");
        $twilio = new Client($sid, $token);

    $message = $twilio->messages->create(
        $formatted_sender_phone, // to
        [
            "body" => "Welcome to WagaExpress Your package is collected from $branch. You paid $price ETB. Thank You for using WagaExpress",
            "from" => $sendernumber
        ]
    );

        dd("message send successfully");

        return redirect(route('products.index'))->with('error', 'error ');
    }



   /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
            return view('admin.show_product', compact('data','price','weight'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Retrieve the product based on the provided ID
       
        $package = package::find($id);
        $customer = customer::find($id);
        // dd($package);
    
        if (!$package || !$customer) {
            // Product with the provided ID does not exist; you can handle this case as per your requirements.
            // For example, you can return an error view or redirect back with a message.
            return redirect()->back()->with('error', 'Product not found.');
        }
    
        return view('admin.edit_product', compact('package',('customer')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customerID = package::where('id', $id)->first();
        $request->validate([
            'sender_name' => 'required',
            'sender_phone' => 'required|unique:customers,phone,'.$customerID->sender_ID.'|digits:9',
            'receiver_name' => 'required',
            'receiver_phone' => 'required|unique:customers,phone,'.$customerID->receiver_ID.'|digits:9',
            'receiver_city' => 'required',
        ]);
        $senderID = package::select('sender_ID')->where('id', $id);
        $receiverID = package::select('receiver_ID')->where('id', $id);
        customer::where('id',$senderID)->update([
            'name' => $request->sender_name,
            'phone' => $request->sender_phone,
        ]);
        customer::where('id',$receiverID)->update([
            'name' => $request->receiver_name,
            'phone' => $request->receiver_phone,
            'city' => $request->receiver_city,
        ]);
        return redirect(route('products.index'))->with('success', 'Updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        package::where('id', $id)->delete();
        return redirect(route('products.index'))->with('success', 'successfully deleted');
    }
    public function fetchPrice(Request $request){
        // $distance_price = Country::select('price')->where('id',$request->id)->first();
        $val1 = $request->fromId;
        $val2 = $request->toId;
        $distance_price = Country::select('price')->where([['fromBranchID',$val1],['toBranchID',$val2]])->orWhere([['fromBranchID',$val2],['toBranchID',$val1]])->first();
        return response()->json($distance_price);  
        
    }

    public function fetchRate(Request $request){
        $rate = WeightPrice::select('rate')->where('id',$request->id)->first();
        return response()->json($rate);  
    }


    public function print($id) {
        // Implement the logic for generating the content you want to print
        // ...
    
        // Return the view or response for the content to be printed
        // ...
    
        // You might also include JavaScript code to trigger the print action
    }

    public function updatePackageStatus(Request $request)
    {
        $id = $request->input('id');

        // Update the status of the package to 'delivered'
        Package::where('id', $id)->update([
            'status' => $request->input('status', 'delivered'),
        ]);

        // Return a response (you can customize this based on your needs)
        return response()->json(['message' => 'Package status updated successfully']);
        
    }
    
       
}
