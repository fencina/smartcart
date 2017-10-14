<?php

namespace App\Http\Controllers\Api;

use App\Group;
use App\Http\Requests\ListFormRequest;
use App\PurchaseList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    public function index(Group $group)
    {
        return response()->json($group->lists);
    }

    public function store(ListFormRequest $request, Group $group)
    {
        $list = new PurchaseList();
        $list->name = $request->input('name');
        $list->group()->associate($group);
        $list->save();

        if ($request->has('products')) {
            $products = collect($request->input('products'))->mapWithKeys(function ($product) {
                return [$product['id'] => ['count' => $product['count']]];
            })->toArray();

            $list->products()->attach($products);
        }

        return response()->json($list->load('products'));
    }

    public function update(ListFormRequest $request, Group $group, PurchaseList $list)
    {
        if ($request->has('name')) {
            $list->name = $request->input('name');
            $list->save();
        }

        if ($request->has('products')) {
            $products = collect($request->input('products'))->mapWithKeys(function ($product) {
                return [$product['id'] => ['count' => $product['count']]];
            })->toArray();

            $list->products()->sync($products);
        }

        return response()->json($list->load('products'));
    }

    public function destroy(Group $group, PurchaseList $list)
    {
        $list->delete();

        return response()->json(['message' => 'Lista eliminada']);
    }
}
