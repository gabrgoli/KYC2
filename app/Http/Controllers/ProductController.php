<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($product)
    {
        if ($product == 'vPOOL') {
            return view('products.product_vPool');
        } elseif ($product == 'vDELEGATOR') {
            return view('products.product_vDelegator');
        } elseif ($product == 'vNFT') {
            return view('products.product_vNFT');
        } elseif ($product == 'vKYC') {
            return view('products.product_vKYC');
        } elseif ($product == 'API') {
            return view('products.product_API');
        } else {
            // Default page if product is not available
            return view('main');
        }
    }

    public function faq() {
        return view('products.faq_vPool');
    }
}
