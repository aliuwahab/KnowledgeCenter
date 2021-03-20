<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ArticleViewed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $articleId;
    public string $viewerIpAddress;

    /**
     * Create a new event instance.
     *
     * @param int $articleId
     * @param string $viewerIpAddress
     */
    public function __construct(int $articleId, string $viewerIpAddress)
    {
        $this->articleId = $articleId;
        $this->viewerIpAddress = $viewerIpAddress;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
