<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConnectionCheckValidation implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private string $id;
    private string $name;
    private string $connetionState;
    private string $date;
    private string $userImage;
    private string $frappeurId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $id, string $name, string $connetionState, string $date, string $userImage, string $frappeurId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->connetionState = $connetionState;
        $this->date = $date;
        $this->userImage = $userImage;
        $this->frappeurId = $frappeurId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('connection-check-validation.' . $this->id);
    }
    public function broadcastWith(): array
    {
        return [
            "id" => $this->id,
            'name' => $this->name,
            'connetionState' => $this->connetionState,
            'date' => $this->date,
            'userImage' => $this->userImage,
            'frappeurId' => $this->frappeurId
        ];
    }
}
