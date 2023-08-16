<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Presence_global implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private string $test;
    private int $room_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $test, int $room_id)
    {
        $this->test = $test;
        $this->room_id = $room_id;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('global');
    }

    // public function broadcastWith(): array
    // {
    //     return [
    //         'test' => $this->test,
    //     ];
    // }
}
