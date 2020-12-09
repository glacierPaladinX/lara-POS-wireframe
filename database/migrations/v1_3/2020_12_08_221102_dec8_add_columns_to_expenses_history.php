<?php

use App\Models\ExpenseHistory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Dec8AddColumnsToExpensesHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nexopos_expenses_history', function (Blueprint $table) {
            $table->string( 'status' )->default( ExpenseHistory::STATUS_ACTIVE );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
