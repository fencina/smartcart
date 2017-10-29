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
     * Store a purchase searching products by epc
     *
     * @param PurchaseFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeFromReader(PurchaseFormRequest $request)
    {
        $purchase = new Purchase();

        $purchase->status()->associate(Status::pending());

        $requestedProducts = collect($request->input('products'));

        $products = Product::whereIn('epc', $requestedProducts->pluck('epc'))->get();

        $purchase->amounts = $products->sum( function ($product) use ($requestedProducts) {
            return $product->price * $requestedProducts->where('epc', $product->epc)->first()['count'];
        });

        $purchase->save();

        $products = $requestedProducts->mapWithKeys(function ($requestedProduct) {
            $product = Product::where('epc', $requestedProduct['epc'])->first();
            return [$product->id => ['count' => 1]];
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
