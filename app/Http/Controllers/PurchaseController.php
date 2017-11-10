<?php

namespace App\Http\Controllers;

use App\Product;
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

        $finalProducts = collect(json_decode($request->input('finalProducts')));
        $products = Product::whereIn('id', $finalProducts->pluck('id'))->get();

        $purchase->amounts = $products->sum( function ($product) use ($finalProducts) {
            return $product->price * $finalProducts->where('id', $product->id)->first()->count;
        });

        $purchase->save();

        $products = $finalProducts->mapWithKeys(function ($product) {
            return [$product->id => ['count' => $product->count]];
        })->toArray();

        $purchase->products()->sync($products);

        return view('purchases.confirm', compact('purchase'));
    }
}