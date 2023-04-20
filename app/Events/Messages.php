<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Messages implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private string $message;
    private string $id; // THE RECEIVER UNIQUE_ID
    private string $senderID;
    private string $senderName;
    private string $senderImage;
    private string $messageType;
    private string $status;
    private string $date;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        string $message,
        string $id,
        string $senderID,
        string $senderName,
        string $senderImage,
        string $messageType,
        string $status,
        string $date
    ) {
        $this->message = $message;
        $this->id = $id; // theREceiver
        $this->senderID = $senderID;
        $this->senderName = $senderName;
        $this->senderImage = $senderImage;
        $this->messageType = $messageType;
        $this->status = $status;
        $this->date = $date;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('message.' . $this->id);
    }
    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [
            'message' => $this->message,
            "id" => $this->id,
            'senderID' => $this->senderID,
            'senderName' => $this->senderName,
            'senderImage' => $this->senderImage,
            'messageType' => $this->messageType,
            'status' => $this->status,
            'date' => $this->date,
        ];
    }
}
