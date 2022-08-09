<?php

namespace App\Events;

use App\Models\CashFlow;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CashFlowHistoryAfterDeletedEvent
{
    use Dispatchable, InteractsWithSockets;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        public $cashFlow
    ) {
        // ...
    }
}
