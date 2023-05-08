<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SetMessagesState implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private string $id; // to who i'm sending
    private string $who_sending; // [who sending,message,date]

    private string $message;

    private string $date;


    private string $state;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $id, $who_sending, $message, $state, $date)
    {
        $this->id = $id;
        $this->who_sending = $who_sending;
        $this->message = $message;
        $this->state = $state;
        $this->date = $date;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('setmessagesstate.' . $this->id);
    }

    public function broadcastWith(): array
    {
        return [
            'message' => $this->message,
            "id" => $this->id,
            'who_sending' => $this->who_sending,
            'state' => $this->state,
            'date' => $this->date,
        ];
    }
}
