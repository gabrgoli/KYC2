<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('main');
    }

    public function connectWallet(Request $request)
    {
        $request->session()->put('wallet', $request->wallet);
        $request->session()->put('bech32', $request->bech32);
    }

    public function disconnectWallet(Request $request)
    {
        $request->session()->forget('wallet');
        $request->session()->forget('bech32');
    }
}
