<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $new_products = Product::CreateStatus()->take(6)->get();
        return view('index',compact('new_products'));
    }
}
