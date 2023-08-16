<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Private_message implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $message;
    private $sender_id;
    private $receipient_id;
    private $is_me;
    private $message_type;
    private $opened = false;
    private $message_state = 'sent';
    private $unique_message_id;
    private $deleted = false;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $message, $sender_id, $receipient_id, $is_me, $message_type, $opened, $message_state, $unique_message_id, $deleted)
    {
        $this->message = $message;
        $this->sender_id = $sender_id;
        $this->receipient_id = $receipient_id;
        $this->is_me = $is_me;
        $this->message_type = $message_type;
        $this->opened = $opened;
        $this->message_state = $message_state;
        $this->unique_message_id = $unique_message_id;
        $this->deleted = $deleted;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('privatemessage.' . $this->receipient_id);
    }
    public function broadcastWith(): array
    {
        return [
            'message' => urldecode($this->message),
            'sender_id' => $this->sender_id,
            "receipient_id" => $this->receipient_id,
            "is_me" => $this->is_me,
            "message_type" => $this->message_type,
            "opened" => $this->opened,
            "message_state" => $this->message_state,
            "unique_message_id" => $this->unique_message_id,
            "deleted" => $this->deleted,
        ];
    }
}
