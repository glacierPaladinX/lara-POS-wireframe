<?php

namespace App\Events;

use App\Models\Customer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderBeforePaymentCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $payment;
    public $customer;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( $payment, Customer $customer )
    {
        $this->payment      =   $payment;
        $this->customer     =   $customer;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('ns.main-socket');
    }
}
