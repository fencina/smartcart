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

    public function broadcast($message, $title = null)
    {
        $notification['message'] = $message;

        if($title) {
            $notification['title'] = $title;
        }

        $this->guzzleClient->request('POST', url('https://api.ionic.io/push/notifications'), [
            'headers' => $this->requestHeaders,
            'json' => [
                "send_to_all" => true,
                "profile" => "dev",
                "notification" => $notification
            ]
        ]);
    }
}