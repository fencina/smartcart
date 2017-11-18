<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationFormRequest;
use App\Notification;
use App\Services\IonicPushNotificationService;
use App\Client;

class NotificationController extends Controller
{
    /**
     * @var IonicPushNotificationService;
     */
    var $pushNotificationService;

    /**
     * NotificationController constructor.
     * @param IonicPushNotificationService $pushNotificationService
     */
    public function __construct(IonicPushNotificationService $pushNotificationService)
    {
        $this->pushNotificationService = $pushNotificationService;
    }

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
        try {
            $this->pushNotificationService->broadcast($request->input('description'), $request->input('title'));

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
