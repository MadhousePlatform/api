<?php

namespace App\Events\Hook\Agent;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Issue implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var string
     */
    public $issue;

    /**
     * @var string
     */
    public $message;

    /**
     * @var array
     */
    public $context;


    /**
     * Create a new event instance.
     *
     * @param string $issue Briefly describe the issue.
     * @param string $message Describe the issue.
     * @param array $context Any additional relevant data.
     */
    public function __construct(string $issue, string $message, array $context = [])
    {
        $this->issue = $issue;
        $this->message = $message;
        $this->context = $context;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array|null
     */
    public function broadcastOn()
    {
        //return new PrivateChannel('AdminNotificationIssues');
    }
}
