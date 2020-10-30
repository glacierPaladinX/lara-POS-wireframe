<?php

namespace App\Jobs;

use App\Events\ExpenseAfterCreateEvent;
use App\Events\ExpenseHistoryAfterCreatedEvent;
use App\Models\DashboardDay;
use App\Services\ReportService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ComputeDashboardExpensesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $event;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $event )
    {
        $this->event    =   $event;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ( $this->event instanceof ExpenseHistoryAfterCreatedEvent ) {
            /**
             * @var ReportService
             */
            $reportService      =   app()->make( ReportService::class );
            $reportService->increaseTodayExpenses( $this->event->expenseHistory );
        }
    }
}
