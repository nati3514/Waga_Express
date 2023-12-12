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

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function received_package(){
        $data= DB::table('packages')
        ->join('customers as t1','t1.id','=','packages.sender_ID')         
        ->join('customers as t2','t2.id','=','packages.receiver_ID')  
        ->join('branches as t3','t3.id','=','packages.from_branch_id')  
        ->join('branches as t4','t4.id','=','packages.to_branch_id')
        ->select('packages.*','t1.name as sender_name','t1.phone as sender_phone','t1.city as sender_city','t3.branch_name as sender_branch','t2.name as receiver_name','t2.phone as receiver_phone','t2.city as receiver_city','t4.branch_name as receiver_branch')
        ->orderBy('packages.created_at', 'desc') // Order by created_at in descending order         
        ->get();
    
    
        return view('admin.received_package_list',compact('data'));
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
               
            ]);

            $price = $request->price;
            $user = Auth::user();
            $senderBranch = User::join('branches','branches.id','=','users.branch_Id')
            ->where('users.id',$user->id)
            ->first();

            if ($senderBranch) {
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
                'package_tag' => 'package-'. Str::random(5),
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
        }


        return redirect(route('products.index'))->with('success', 'Registration successfull');
    }



   /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.show_product');
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

    public function receive_package($id) {
        // Get the authenticated user
        $user = Auth::user();
    
        // Retrieve the branch ID associated with the user
        $branchID = User::join('branches', 'branches.id', '=', 'users.branch_Id')
            ->where('users.id', $user->id)
            ->first();
    
        // Retrieve information about the package with the given ID
        $packageData = Package::where('id', $id)->first();
    
        // Retrieve the percentage of delivery for calculating the commission
        $percentDelivered = Percent::select('percent')->where('status', 'delivered')->first();
        $percentDelivered = Percent::where('status','delivered')->first();
        // dd($percentDelivered->percent);
        // Retrieve the transaction price associated with the package
        $price = Transaction::where('package_id_fk', $id)->first();
    
        // Check if the package is intended for the current branch of the authenticated user
        if ($packageData->to_branch_id == $branchID->branch_Id) {
            // Retrieve the current balance of the destination branch
            $branchBalance = Branch::where('id', $packageData->to_branch_id)->first();

            $deduct_amount = 0;
            
            $com_amount = ($price->price * (($percentDelivered->percent) / 100));
    
            // Calculate the total balance after adding the commission
            $total = $branchBalance->balance + ($price->price * (($percentDelivered->percent) / 100));
            // dd($tot);
    
            $transaction = Transaction::create([
                'branch_id_fk' => $branchID->branch_Id,
                'package_id_fk' => $id,
                'status' => $percentDelivered->status,
                'percent' => $percentDelivered->percent,
                'price' => $price->price,
                'Ded_amount' => $deduct_amount,
                'commission' => $com_amount,
                'current_balance' => $total,

                
            ]);
            
            // Update the balance of the destination branch
            $totalCommission = Branch::where('id', $packageData->to_branch_id)->update([
                'balance' => $total,
            ]);
    
            // Update the status of the package to 'delivered'
            Package::where('id', $id)->update([
                'status' => 'delivered',
            ]);
    
            // Redirect back with a success message
            return back()->with('success', 'Successfully received');
        } else {
            // If the package is not intended for the current branch, show an error message
            return back()->with('error', 'You cannot receive this package');
        }
    }
    
}