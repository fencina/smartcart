<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => false,

    'http' => [
        'server_key' => env('FCM_SERVER_KEY', 'AAAALHnd7L8:APA91bFUNHH2bcYq9XtS2vmqk8k9tAZagcx7IjgsozHfgc6ynmuNZFcuzXEeU9EM9I8AzXUZjyhblw_-yuT_wdYWP9wsYl_MMkVGpdNnK6-id1qhIuj-tkAJVJLnwWMpcKJZeJw99p0-'),
        'sender_id' => env('FCM_SENDER_ID', '191023148223'),
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],
];
