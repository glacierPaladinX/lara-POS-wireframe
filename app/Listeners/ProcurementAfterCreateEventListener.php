<?php

namespace App\Listeners;

use App\Events\ProcurementAfterCreateEvent;
use App\Services\ProcurementService;
use App\Services\ProviderService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProcurementAfterCreateEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        public ProcurementService $procurementService,
        public ProviderService $providerService
    )
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle( ProcurementAfterCreateEvent $event )
    {
        $this->procurementService->refresh( $event->procurement );
        $this->providerService->computeSummary( $event->procurement->provider );
        $this->procurementService->handleProcurement( $event->procurement );
        $this->expenseService->handleProcurementExpense( $event->procurement );
    }
}
