<?php

namespace App\Http\Controllers\Api;

use App\Events\PurchaseCreated;
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
     * @param PurchaseFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PurchaseFormRequest $request)
    {
        $purchase = new Purchase();

        $purchase->status()->associate(Status::pending());

        $requestedProducts = collect($request->input('products'));
        $products = Product::whereIn('id', $requestedProducts->pluck('id'))->get();

        $purchase->amounts = $products->sum( function ($product) use ($requestedProducts) {
            return $product->price * $requestedProducts->where('id', $product->id)->first()['count'];
        });

        $purchase->save();

        $products = $requestedProducts->mapWithKeys(function ($product) {
            return [$product['id'] => ['count' => $product['count']]];
        })->toArray();

        $purchase->products()->attach($products);

        event(new PurchaseCreated());

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
        $count = 1;

        $purchase->amounts = $products->sum( function ($product) use ($requestedProducts, $count) {
            return $product->price * $count;
        });

        $purchase->save();

        $products = $requestedProducts->mapWithKeys(function ($requestedProduct) use ($count) {
            $product = Product::where('epc', $requestedProduct['epc'])->first();
            return [$product->id => ['count' => $count]];
        })->toArray();

        $purchase->products()->attach($products);

        event(new PurchaseCreated());

        return response()->json($purchase->load('products'));
    }

    /**
     * Return latest pending purchase if any
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function pendingPurchase()
    {
        return response()->json(Purchase::pending()->latest()->first());
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
