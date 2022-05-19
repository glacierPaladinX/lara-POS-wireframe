<?php

namespace App\Events;

use App\Models\Product;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductAfterCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $product;
    public $fields;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( Product $product, $fields )
    {
        $this->product      =   $product;
        $this->fields       =   $fields;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('ns.private-channel');
    }
}
