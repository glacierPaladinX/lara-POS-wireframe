<?php
/**
 * Table Migration
 * @package  5.0
**/

use App\Classes\Hook;
use App\Classes\Schema;;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        if ( ! Schema::hasTable( 'nexopos_products_taxes' ) ) {
            Schema::createIfMissing( 'nexopos_products_taxes', function( Blueprint $table ) {
                $table->bigIncrements( 'id' );
                $table->integer( 'product_id' );
                $table->integer( 'unit_quantity_id' );
                $table->string( 'tax_id' ); // grouped, simple
                $table->string( 'name' );
                $table->float( 'rate', 11, 5 );
                $table->float( 'value', 11, 5 ); // actual computed tax value
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
        if ( Schema::hasTable( 'nexopos_products_taxes' ) ) {
            Schema::dropIfExists( 'nexopos_products_taxes' );
        }
    }
}

