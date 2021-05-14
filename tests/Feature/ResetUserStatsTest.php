<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResetUserStatsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        User::get()->each( function( $user ) {
            $user->total_sales_count    =   0;
            $user->total_sales          =   0;
            $user->save();
        });

        $this->assertTrue(true);
    }
}
