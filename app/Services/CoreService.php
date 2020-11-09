<?php
namespace App\Services;

use App\Exceptions\NotEnoughPermissionException;
use App\Services\Helpers\App;
use Illuminate\Support\Facades\Auth;

class CoreService
{
    /**
     * @param CurrenService;
     */
    public $currency;

    /**
     * @var boolean
     */
    public $isMultistore    =   false;
    public $storeID;
    public $store;

    /**
     * @param UpdateService
     */
    public $update;
    
    public function __construct()
    {
        $this->currency     =   app()->make( CurrencyService::class );
        $this->update       =   new UpdateService;
        $this->date         =   app()->make( DateService::class );
        $this->order        =   app()->make( OrdersService::class );
        $this->modules      =   app()->make( ModulesService::class );
    }

    public function installed()
    {
        return Helper::installed();
    }

    public function route( $route, $params = [])
    {
        return route( $route, $params );
    }

    /**
     * check if a use is allowed to
     * access a page or trigger an error. This should not be used
     * on middleware or controller constructor.
     */
    public function restrict( $permissions, $message = '' )
    {
        $passed     =   $this->allowedTo( $permissions );

        if ( ! $passed ) {
            throw new NotEnoughPermissionException( $message ?: __( 'Your don\'t have enough permission to see this page.' ) );
        }
    }    

    public function allowedTo( $permissions ): bool
    {
        $passed     =   false;

        collect( $permissions )->each( function( $permission ) use ( &$passed ) {
            $userPermissionsNamespaces    =   collect( Auth::user()->role->permissions )
                ->map( fn( $permission ) => $permission->namespace )
                ->toArray();

            /**
             * if there is a match with the permission or the provided permission is "true" 
             * that causes permission check bypass.
             */
            $passed     =   in_array( $permission, $userPermissionsNamespaces ) || $permission === true;
        });

        return $passed;
    }
}