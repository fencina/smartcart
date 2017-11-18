<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
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
}
