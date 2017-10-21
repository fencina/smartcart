<?php

namespace App\Http\Controllers\Api;

use App\Product;
use App\Purchase;
use App\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchasesController extends Controller
{

    /**
     * Store a newly created resource in storage.http://{{host}}/api/search/groups?personal=0
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $purchase = new Purchase();

        $pendingStatus = Status::pending();
        $purchase->status()->associate($pendingStatus);

        $products = Product::whereIn('id', $request->input('products'))->get();
        $purchase->amounts = $products->sum->price;

        $purchase->save();

        if ($request->has('product')) {
            $purchase->products()->attach($request->input('product'));
        }

        return response()->json($purchase->load('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Purchase::find($id);
    }

    public function update(Request $request, Purchase $purchase)
    {
        $purchase->update($request->all());

        return response()->json($purchase, 200);
    }
}
