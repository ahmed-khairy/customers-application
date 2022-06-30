<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Customer;
use App\Models\Delivery;
use App\Models\Marketer;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $customers = Customer::all();
        $deliveries = Delivery::all();
        $marketers = Marketer::all();
        $products = Product::all();
        $addresses = Address::all();
        return view('dashboard', [
            "customers" => $customers,
            "deliveries" => $deliveries,
            "marketers" => $marketers,
            "products" => $products,
            "addresses" => $addresses,
        ]);
    }
}
