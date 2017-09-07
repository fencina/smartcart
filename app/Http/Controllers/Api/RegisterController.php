<?php

namespace App\Http\Controllers\Api;

use App\Client;
use App\Http\Requests\ClientRegisterRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function register(ClientRegisterRequest $request)
    {
        $client = Client::create($request->all());
        $client->password = bcrypt($request->input('password'));

        return response()->json($client->toArray());
    }
}
