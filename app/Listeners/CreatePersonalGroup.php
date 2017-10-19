<?php

namespace App\Listeners;

use App\Events\ClientCreated;
use App\Group;

class CreatePersonalGroup
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ClientCreated  $event
     * @return void
     */
    public function handle(ClientCreated $event)
    {
        $group = new Group();
        $group->name = 'Personal Group for ' . $event->client->email;
        $group->personal = true;
        $group->save();

        $group->clients()->attach($event->client->id, ['owner' => true]);
    }
}
