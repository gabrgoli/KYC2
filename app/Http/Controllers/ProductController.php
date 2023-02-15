<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($product) {

        if ($product == 'vPool') {
            return view('products.product_vPool');
        } elseif ($product == 'vDelegate') {
            return view('products.product_vDelegate');
        } elseif ($product == 'vNFT') {
            return view('products.product_vNFT');
        } elseif ($product == 'vKYC') {
           return view('product_vKYC');
        } elseif ($product == 'API') {
            return view('product_API');
        } else {
            // Default page if product is not available
            return view('main');
        }
    }
}
