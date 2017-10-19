<?php

namespace App\Events;

use App\Client;

class ClientCreated
{
    /**
     * @var Client
     */
    public $client;

    /**
     * ClientCreated constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
