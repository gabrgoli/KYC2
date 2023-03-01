<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;

class ThankYouController extends Controller
{
    public function index(Request $request) {

        $userUUID = $request->UUID;
        $customer = Customer::where('UUID', $userUUID)->first();
        $dbProduct = DB::table('products')
        ->where('id', '=', $customer->product_id)
        ->first();
        $request->session()->forget('uuid');
        $request->session()->forget('product');
		return view('thankyou', compact('dbProduct'))->with('data', $customer);

    }
}
