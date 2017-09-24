<?php

namespace App\Http\Controllers\Api;

use App\Client;
use App\Http\Requests\ClientLoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function login(ClientLoginRequest $request)
    {

        $client = new \GuzzleHttp\Client();

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
    }

    public function facebookLogin(Request $request)
    {
        return $this->resolveSocialLogin($request, 'facebook');
    }

    public function googleLogin(Request $request)
    {
        return $this->resolveSocialLogin($request, 'google');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function resolveSocialLogin(Request $request, $driver)
    {
        $socialClient = Socialite::driver($driver)->userFromToken($request->input('token'));

        list($name, $lastName) = explode(' ', $socialClient->name);

        if (!Client::isRegistered($socialClient->email)) {
            $smartcartClient = Client::create([
                'name' => $name,
                'last_name' => $lastName,
                'email' => $socialClient->email,
            ]);
        } else {
            $smartcartClient = Client::where('email', $socialClient->email)->first();
        }

        return response()->json($smartcartClient, 200);
    }

}
