<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\customer;
use App\Models\package;
use App\Models\PackageCategory;
use App\Models\Product;
use App\Models\User;
use App\Models\WeightPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data= DB::table('packages')
        ->join('customers as t1','t1.id','=','packages.sender_ID')         
        ->join('customers as t2','t2.id','=','packages.receiver_ID')  
        ->join('branches as t3','t3.id','=','packages.from_branch_id')  
        ->join('branches as t4','t4.id','=','packages.to_branch_id')
        ->select('packages.*','t1.name as sender_name','t1.phone as sender_phone','t1.city as sender_city','t3.branch_name as sender_branch','t2.name as receiver_name','t2.phone as receiver_phone','t2.city as receiver_city','t4.branch_name as receiver_branch')        
        ->get();

        $receiversBranch = DB::table('branches')->get();
        // dd($data);
        return view('admin.view_all_products',compact('data','receiversBranch')); 
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
        return view('admin.create_product',compact('data', 'firstBranch','receiversBranch','weight'));
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
            // dd($request->to_branch);
            $data= $request->validate([
                'sender_name' => 'required',
                'sender_phone' => 'required|unique:customers,phone|max:9',
                'from_branch' => 'required',
                'sender_city' => 'required',
                'receiver_name' => 'required',
                'receiver_phone' => 'required|unique:customers,phone|max:9',
                'to_branch' => 'required',
                'receiver_city' => 'required',
                // 'from_to' => 'required',
                'package_type' => 'required',
                'weight' => 'required',
                'status' => 'required',
               
            ]);
            $senderInfo = customer::create([
                'name' => $request->sender_name,
                'phone' => $request->sender_phone,
                'city' => $request->sender_city,
            
            ]);
            $receiverInfo = customer::create([
                'name' => $request->receiver_name,
                'phone' => $request->receiver_phone,
                'city' => $request->receiver_city,
            ]);
       
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
            'sender_phone' => 'required|unique:customers,phone,'.$customerID->sender_ID.'|max:9',
            'receiver_name' => 'required',
            'receiver_phone' => 'required|unique:customers,phone,'.$customerID->receiver_ID.'|max:9',
            // 'to_branch' => 'required',
            // 'receiver_city' => 'required',
        ]);
        $senderID = package::select('sender_ID')->where('id', $id);
        $receiverID = package::select('receiver_ID')->where('id', $id);
        customer::where('id',$senderID->first())->update([
            'name' => $request->sender_name,
            'phone' => $request->sender_phone,
        ]);
        customer::where('id',$receiverID->first())->update([
            'name' => $request->receiver_name,
            'phone' => $request->receiver_phone,
            // 'city' => $request->receiver_city,
        ]);
        // package::where('id',$id)->update([
        //     'to_branch_id' =>$request->to_branch,
        // ]);
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

}
