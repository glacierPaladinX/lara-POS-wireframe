<?php
/**
 * Table Migration
 * @package  5.0
**/

use App\Classes\Hook;
use App\Classes\Schema;;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        if ( ! Schema::hasTable( 'nexopos_procurements' ) ) {
            Schema::createIfMissing( 'nexopos_procurements', function( Blueprint $table ) {
                $table->bigIncrements( 'id' );
                $table->string( 'name' );
                $table->integer( 'provider_id' );
                $table->float( 'value', 18, 5 )->default(0);
                $table->float( 'cost', 18, 5 )->default(0);
                $table->float( 'tax_value', 18, 5 )->default(0);
                $table->string( 'invoice_reference' )->nullable();
                $table->boolean( 'automatic_approval' )->default(false)->nullable();
                $table->datetime( 'delivery_time' )->nullable();
                $table->string( 'payment_status' )->default( 'unpaid' ); // paid | unpaid
                $table->string( 'delivery_status' )->default( 'unpaid' ); // paid | unpaid
                $table->integer( 'total_items' )->default(0);
                $table->text( 'description' )->nullable();
                $table->integer( 'author' );
                $table->string( 'uuid' )->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        if ( Schema::hasTable( 'nexopos_procurements' ) ) {
            Schema::dropIfExists( 'nexopos_procurements' );
        }
    }
}

