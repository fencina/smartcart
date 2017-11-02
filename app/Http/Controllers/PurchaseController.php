<?php

namespace App\Http\Controllers;

use App\Purchase;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchase = Purchase::pending()->latest()->first();

        return view('purchases.index', compact('purchase'));
    }
}