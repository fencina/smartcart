<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Add client's device token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addDeviceToken(Request $request)
    {
        $this->validate($request, [
            'device_token' => 'required'
        ]);

        $authUser = Auth::user();
        $authUser->device_token = $request->input('device_token');
        $authUser->save();

        return response()->json($authUser);
    }

    /**
     * Return all client's purchases
     *
     * @return mixed
     */
    public function purchases()
    {
        return Auth::user()->groups->map->purchases->flatten()->sortByDesc('created_at')->map(function ($purchase) {
            return $purchase->load('products');
        })->flatten();
    }
}
