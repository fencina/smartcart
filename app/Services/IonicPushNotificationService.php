<?php

namespace App\Services;

use GuzzleHttp\Client as GuzzleClient;

class IonicPushNotificationService
{
    /**
     * @var GuzzleClient
     */
    protected $guzzleClient;

    /**
     * @var array
     */
    protected $requestHeaders;

    public function __construct(GuzzleClient $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
        $this->requestHeaders = [
            'Authorization' => 'Bearer ' . env('IONIC_APP_TOKEN')
        ];
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
        $requestBody = [
            "send_to_all" => $toAll,
            "profile" => "dev",
            "notification" => $notification
        ];

        if ($tokens) {
            $requestBody['tokens'] = $tokens;
        }

        if ($payload) {
            $requestBody['payload'] = $payload;
        }

        $this->guzzleClient->request('POST', url('https://api.ionic.io/push/notifications'), [
            'headers' => $this->requestHeaders,
            'json' => $requestBody
        ]);
    }
}