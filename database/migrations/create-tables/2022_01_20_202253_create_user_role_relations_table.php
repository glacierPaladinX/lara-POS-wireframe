<?php

use App\Models\Role;
use App\Models\User;
use App\Models\UserRoleRelation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRoleRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable( 'users_roles_relations' ) ) {
            Schema::create('users_roles_relations', function (Blueprint $table) {
                $table->id();
                $table->integer( 'role_id' );
                $table->integer( 'user_id' );
                $table->timestamps();
            });
        }

        Role::get()->each( function( $role ) {
            User::where( 'role_id', $role->id )
                ->get()
                ->each( function( $user ) use ( $role ) {
                    $relation           =   new UserRoleRelation;
                    $relation->user_id  =   $user->id;
                    $relation->role_id  =   $role->id;
                    $relation->save();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_role_relations');
    }
}
