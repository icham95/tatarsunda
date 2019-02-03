<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AdminConfirmationArticle implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $title;
    public $id;
    public $user_id;
    public $status;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id, $title, $user_id, $status)
    {
        $this->title = $title;
        $this->id = $id;
        $this->user_id = $user_id;
        $this->status = $status;
        if ($status == 1) {
            $this->message  = "{$title} telah di publish.";
        }
        if ($status == 3) {
            $this->message  = "{$title} telah di tolak.";
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['channel_' . $this->user_id];
    }
}
