<?php

namespace App\Http\Controllers;

use App\Purchases;
use Illuminate\Http\Request;

class PurchasesController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $purchases = new Purchases();
        $purchases->save();

        if ($request->has('product')) {
            $purchases->products()->attach($request->input('product'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Purchases::find($id);
    }

    public function update(Request $request, Purchases $purchase)
    {
        $purchase->update($request->all());

        return response()->json($purchase, 200);
    }
}
