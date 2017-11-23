<?php

namespace App\Services;

use App\Client;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class FCMPushNotificationService
{
    /**
     * Notification's options
     *
     * @var \LaravelFCM\Message\Options
     */
    protected $options;


    public function __construct()
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);
        $this->options = $optionBuilder->build();
    }

    /**
     * Send a notification to all clients
     *
     * @param $message
     * @param null $title
     */
    public function broadcast($message, $title = null, $payload = null)
    {
        $this->send($this->buildNotification($message, $title), true, null, $payload);
    }

    /**
     * Send notifications to a client segment
     *
     * @param $tokens
     * @param $message
     * @param null $title
     */
    public function sendTo($tokens, $message, $title = null, $payload = null)
    {
        $this->send($this->buildNotification($message, $title), false, $tokens, $payload);
    }

    /**
     * Build notification array with message and title (optional)
     *
     * @param $message
     * @param null $title
     * @return array
     */
    protected function buildNotification($message, $title = null)
    {
        $notification['message'] = $message;

        if($title) {
            $notification['title'] = $title;
        }

        return $notification;
    }

    /**
     * Send push notification through ionic API
     *
     * @param $notification
     * @param bool $toAll
     * @param null $tokens
     * @param null $payload
     */
    protected function send($notification, $toAll = false, $tokens = null, $payload = null)
    {
        $notificationBuilder = new PayloadNotificationBuilder($notification['title'] ?? null);
        $notificationBuilder->setBody($notification['message'])
            ->setSound('default');

        if ($payload) {
            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData($payload);
            $data = $dataBuilder->build();
        }

        $notification = $notificationBuilder->build();

        if (isset($tokens) AND is_array($tokens) AND empty($tokens)) {
            return;
        }

        FCM::sendTo($tokens ?? Client::all()->pluck('device_token')->toArray(), $this->options, $notification, $data ?? null);
    }
}