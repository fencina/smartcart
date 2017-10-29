<?php

namespace App\Http\Controllers\Api;

use App\Group;
use App\Http\Requests\PurchaseFormRequest;
use App\Product;
use App\Purchase;
use App\Status;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PurchasesController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseFormRequest $request)
    {
        $purchase = new Purchase();

        $purchase->status()->associate(Status::pending());

        $products = Product::whereIn('id', $request->input('products'))->get();
        $requestedProducts = collect($request->input('products'));

        $purchase->amounts = $products->sum( function ($product) use ($requestedProducts) {
            return $product->price * $requestedProducts->where('id', $product->id)->first()['count'];
        });

        $purchase->save();

        $products = $requestedProducts->mapWithKeys(function ($product) {
            return [$product['id'] => ['count' => $product['count']]];
        })->toArray();

        $purchase->products()->attach($products);

        return response()->json($purchase->load('products'));
    }

    /**
     *  Display the specified resource.
     *
     * @param Purchase $purchase
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Group $group, Purchase $purchase)
    {
        if (!Auth::user()->groups->contains($group)) {
            throw (new ModelNotFoundException())->setModel(Group::class);
        }

        return response()->json($group->purchases()->where('id', $purchase->id)->first());
    }

}
