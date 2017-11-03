<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\Status;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchase = Purchase::pending()->latest()->first();

        return view('purchases.index', compact('purchase'));
    }

    public function confirm(Request $request, Purchase $purchase)
    {
        $purchase->status()->associate(Status::confirmed());
        $purchase->save();

        return view('purchases.confirm', compact('purchase'));
    }
}