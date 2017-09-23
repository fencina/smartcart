<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationFormRequest;
use App\Notification;
use GuzzleHttp\Client as GuzzleClient;
use App\Client;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::paginate(10);

        return view('notifications.index', compact('notifications'));
    }

    public function create()
    {
        return view('notifications.create');
    }

    public function store(NotificationFormRequest $request)
    {
        $guzzleClient = new GuzzleClient();

        $headers = [
            'Authorization' => 'Bearer ' . env('IONIC_APP_TOKEN')
        ];

        $notification = [
            "message" => $request->input('description')
        ];

        if ($request->has('title')) {
            $notification['title'] = $request->input('title');
        }

        try {
            $guzzleClient->request('POST', url('https://api.ionic.io/push/notifications'), [
                'headers' => $headers,
                'json' => [
                    "send_to_all" => true,
                    "profile" => "dev",
                    "notification" => $notification
                ]
            ]);

            $notification = new Notification();
            $notification->fill($request->all());
            $notification->sent_count = Client::count();
            $notification->save();

            return redirect('notifications')->withSuccess('Notificación enviada');
        } catch (\Exception $e) {
            return redirect()->route('notifications.index')->withErrors($e->getMessage());
        }
    }
}