<?php

namespace App\Base\Renter\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BalanceUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public readonly User $renter)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\PrivateChannel
     */
    public function broadcastOn() : PrivateChannel
    {
        return new PrivateChannel("user-".$this->renter->id);
    }

    /**
     * The event"s broadcast name.
     */
    public function broadcastAs() : string
    {
        return "renter.balance_updated";
    }

    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith() : array
    {
        return [
            "result" => [
                "renter_id" => $this->renter->id,
            ]
        ];
    }

    /**
     * The name of the queue on which to place the broadcasting job.
     */
    public function broadcastQueue() : string
    {
        return "broadcast";
    }
}
