<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('POST', url('/oauth/token'), [
                'json' => [
                    "grant_type" => "password",
                    "client_id" => 2,
                    "client_secret" => "XOry4JuJewq9pOaA7us4DQsoBNxgiDDyzxjlRgRO",
                    "username" => $request->input('email'),
                    "password" => $request->input('password')
                ]
            ]);

            $response = json_decode($response->getBody()->getContents());

            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
