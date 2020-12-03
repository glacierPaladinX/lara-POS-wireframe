<?php
namespace App\Crud;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\CrudService;
use App\Services\Users;
use App\Models\User;
use TorMorten\Eventy\Facades\Events as Hook;
use Exception;
use App\Models\Unit;
use App\Models\UnitGroup;
use App\Services\Helper;

class UnitCrud extends CrudService
{
    /**
     * define the base table
     */
    protected $table      =   'nexopos_units';

    /**
     * base route name
     */
    protected $mainRoute      =   'ns.units';

    /**
     * Define namespace
     * @param  string
     */
    protected $namespace  =   'ns.units';

    /**
     * Model Used
     */
    protected $model      =   Unit::class;

    /**
     * Adding relation
     */
    public $relations   =  [
        [ 'nexopos_users as user', 'nexopos_units.author', '=', 'user.id' ],
        [ 'nexopos_units_groups as group', 'nexopos_units.group_id', '=', 'group.id' ],
    ];

    /**
     * Define where statement
     * @var  array
    **/
    protected $listWhere    =   [];

    /**
     * Define where in statement
     * @var  array
     */
    protected $whereIn      =   [];

    /**
     * Fields which will be filled during post/put
     */
    public $fillable    =   [];

    protected $permissions = [
        'create' => 'nexopos.create.products-units',
        'read' => 'nexopos.read.products-units',
        'update' => 'nexopos.update.products-units',
        'delete' => 'nexopos.delete.products-units',
    ];

    /**
     * Define Constructor
     * @param  
     */
    public function __construct()
    {
        parent::__construct();

        Hook::addFilter( $this->namespace . '-crud-actions', [ $this, 'setActions' ], 10, 2 );
    }

    /**
     * Return the label used for the crud 
     * instance
     * @return  array
    **/
    public function getLabels()
    {
        return [
            'list_title'            =>  __( 'Units List' ),
            'list_description'      =>  __( 'Display all units.' ),
            'no_entry'              =>  __( 'No units has been registered' ),
            'create_new'            =>  __( 'Add a new unit' ),
            'create_title'          =>  __( 'Create a new unit' ),
            'create_description'    =>  __( 'Register a new unit and save it.' ),
            'edit_title'            =>  __( 'Edit unit' ),
            'edit_description'      =>  __( 'Modify  Unit.' ),
            'back_to_list'          =>  __( 'Return to Units' ),
        ];
    }

    /**
     * Check whether a feature is enabled
     * @return  boolean
    **/
    public function isEnabled( $feature )
    {
        return false; // by default
    }

    /**
     * Fields
     * @param  object/null
     * @return  array of field
     */
    public function getForm( $entry = null ) 
    {
        return [
            'main' =>  [
                'label'         =>  __( 'Name' ),
                'name'          =>  'name',
                'value'         =>  $entry->name ?? '',
                'description'   =>  __( 'Provide a name to the resource.' )
            ],
            'tabs'  =>  [
                'general'   =>  [
                    'label'     =>  __( 'General' ),
                    'fields'    =>  [
                        [
                            'type'  =>  'media',
                            'name'  =>  'preview_url',
                            'label' =>  __( 'Preview URL' ),
                            'description'   =>  __( 'Preview of the unit.' ),
                            'value' =>  $entry->preview_url ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'value',
                            'label' =>  __( 'Value' ),
                            'description'   =>  __( 'Define the value of the unit.' ),
                            'validation'    =>  'required',
                            'value' =>  $entry->value ?? '',
                        ], [
                            'type'          =>  'select',
                            'name'          =>  'group_id',
                            'validation'    =>  'required',
                            'options'       =>  Helper::toJsOptions( UnitGroup::get(), [ 'id', 'name' ] ),
                            'label'         =>  __( 'Group' ),
                            'description'   =>  __( 'Define to which group the unit should be assigned.' ),
                            'value' =>  $entry->group_id ?? '',
                        ], [
                            'type'  =>  'switch',
                            'name'  =>  'base_unit',
                            'validation'    =>  'required',
                            'options'       =>  Helper::kvToJsOptions([ __( 'No' ), __( 'Yes' ) ]),
                            'label'         =>  __( 'Base Unit' ),
                            'description'   =>  __( 'Determine if the unit is the base unit from the group.' ),
                            'value'         =>  $entry ? ( $entry->base_unit ? 1 : 0 ) : 0,
                        ], [
                            'type'  =>  'textarea',
                            'name'  =>  'description',
                            'label' =>  __( 'Description' ),
                            'description'   =>  __( 'Provide a short description about the unit.' ),
                            'value' =>  $entry->description ?? '',
                        ], 
                    ]
                ]
            ]
        ];
    }

    /**
     * Filter POST input fields
     * @param  array of fields
     * @return  array of fields
     */
    public function filterPostInputs( $inputs )
    {
        return $inputs;
    }

    /**
     * Filter PUT input fields
     * @param  array of fields
     * @return  array of fields
     */
    public function filterPutInputs( $inputs, Unit $entry )
    {
        return $inputs;
    }

    /**
     * Before saving a record
     * @param  Request $request
     * @return  void
     */
    public function beforePost( $request )
    {
        $this->allowedTo( 'create' );

        return $request;
    }

    /**
     * After saving a record
     * @param  Request $request
     * @param  Unit $entry
     * @return  void
     */
    public function afterPost( $request, Unit $entry )
    {
        return $request;
    }

    
    /**
     * get
     * @param  string
     * @return  mixed
     */
    public function get( $param )
    {
        switch( $param ) {
            case 'model' : return $this->model ; break;
        }
    }

    /**
     * Before updating a record
     * @param  Request $request
     * @param  object entry
     * @return  void
     */
    public function beforePut( $request, $entry )
    {
        $this->allowedTo( 'update' );

        return $request;
    }

    /**
     * After updating a record
     * @param  Request $request
     * @param  object entry
     * @return  void
     */
    public function afterPut( $request, $entry )
    {
        return $request;
    }
    
    /**
     * Protect an access to a specific crud UI
     * @param  array { namespace, id, type }
     * @return  array | throw Exception
    **/
    public function canAccess( $fields )
    {
        $users      =   app()->make( Users::class );
        
        if ( $users->is([ 'admin' ]) ) {
            return [
                'status'    =>  'success',
                'message'   =>  __( 'The access is granted.' )
            ];
        }

        throw new Exception( __( 'You don\'t have access to that ressource' ) );
    }

    /**
     * Before Delete
     * @return  void
     */
    public function beforeDelete( $namespace, $id, $model ) {
        if ( $namespace == 'ns.units' ) {
            $this->allowedTo( 'delete' );        
        }
    }

    /**
     * Define Columns
     * @return  array of columns configuration
     */
    public function getColumns() {
        return [
            
            'name'  =>  [
                'label'  =>  __( 'Name' ),
                '$direction'    =>  '',
                '$sort'         =>  false
            ],
            'value'  =>  [
                'label'  =>  __( 'Value' ),
                '$direction'    =>  '',
                '$sort'         =>  false
            ],
            'base_unit'  =>  [
                'label'  =>  __( 'Base Unit' ),
                '$direction'    =>  '',
                '$sort'         =>  false
            ],
            'group_name'  =>  [
                'label'         =>  __( 'Group' ),
                '$direction'    =>  '',
                '$sort'         =>  false
            ],
            'user_username'  =>  [
                'label'         =>  __( 'Author' ),
                '$direction'    =>  '',
                '$sort'         =>  false
            ],
            'created_at'  =>  [
                'label'  =>  __( 'Created At' ),
                '$direction'    =>  '',
                '$sort'         =>  false
            ],
        ];
    }

    /**
     * Define actions
     */
    public function setActions( $entry, $namespace )
    {
        // Don't overwrite
        $entry->{ '$checked' }  =   false;
        $entry->{ '$toggled' }  =   false;
        $entry->{ '$id' }       =   $entry->id;

        $entry->base_unit       =   ( bool ) $entry->base_unit ? __( 'Yes' ) : __( 'No' );
        // you can make changes here
        $entry->{'$actions'}    =   [
            [
                'label'         =>      __( 'Edit' ),
                'namespace'     =>      'edit',
                'type'          =>      'GOTO',
                'index'         =>      'id',
                'url'           =>      ns()->url( '/dashboard/' . 'units' . '/edit/' . $entry->id )
            ], [
                'label'     =>  __( 'Delete' ),
                'namespace' =>  'delete',
                'type'      =>  'DELETE',
                'url'       =>  ns()->url( '/api/nexopos/v4/crud/ns.units/' . $entry->id ),
                'confirm'   =>  [
                    'message'  =>  __( 'Would you like to delete this ?' ),
                ]
            ]
        ];

        return $entry;
    }

    
    /**
     * Bulk Delete Action
     * @param    object Request with object
     * @return    false/array
     */
    public function bulkAction( Request $request ) 
    {
        /**
         * Deleting licence is only allowed for admin
         * and supervisor.
         */
        $user   =   app()->make( Users::class );
        if ( ! $user->is([ 'admin', 'supervisor' ]) ) {
            return response()->json([
                'status'    =>  'failed',
                'message'   =>  __( 'You\'re not allowed to do this operation' )
            ], 403 );
        }

        if ( $request->input( 'action' ) == 'delete_selected' ) {
            $status     =   [
                'success'   =>  0,
                'failed'    =>  0
            ];

            foreach ( $request->input( 'entries' ) as $id ) {
                $entity     =   $this->model::find( $id );
                if ( $entity instanceof Unit ) {
                    $entity->delete();
                    $status[ 'success' ]++;
                } else {
                    $status[ 'failed' ]++;
                }
            }
            return $status;
        }

        return Hook::filter( $this->namespace . '-catch-action', false, $request );
    }

    /**
     * get Links
     * @return  array of links
     */
    public function getLinks()
    {
        return  [
            'list'      =>  'ns.units',
            'create'    =>  'ns.units/create',
            'edit'      =>  'ns.units/edit/#'
        ];
    }

    /**
     * Get Bulk actions
     * @return  array of actions
    **/
    public function getBulkActions()
    {
        return Hook::filter( $this->namespace . '-bulk', [
            [
                'label'         =>  __( 'Delete Selected Groups' ),
                'identifier'    =>  'delete_selected',
                'url'           =>  ns()->route( 'ns.api.crud-bulk-actions', [
                    'namespace' =>  $this->namespace
                ])
            ]
        ]);
    }

    /**
     * get exports
     * @return  array of export formats
    **/
    public function getExports()
    {
        return [];
    }
}