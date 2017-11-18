<?php

namespace App\Http\Controllers\Api;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function addDeviceToken(Request $request, Client $client)
    {
        $this->validate($request, [
            'device_token' => 'required'
        ]);

        $client->device_token = $request->input('device_token');
        $client->save();

        return response()->json($client);
    }
}
