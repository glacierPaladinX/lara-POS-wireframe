<?php
namespace App\Crud;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\CrudService;
use App\Services\Users;
use App\Models\User;
use TorMorten\Eventy\Facades\Events as Hook;
use Exception;
use App\Models\Order;

class OrderCrud extends CrudService
{
    /**
     * define the base table
     */
    protected $table      =   'nexopos_orders';

    /**
     * base route name
     */
    protected $mainRoute      =   'ns.orders';

    /**
     * Define namespace
     * @param  string
     */
    protected $namespace  =   'ns.orders';

    /**
     * Model Used
     */
    protected $model      =   Order::class;

    /**
     * Adding relation
     */
    public $relations   =  [
        [ 'nexopos_users', 'nexopos_orders.author', '=', 'nexopos_users.id' ],
        [ 'nexopos_customers', 'nexopos_customers.id', '=', 'nexopos_orders.customer_id' ],
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
            'list_title'            =>  __( 'Orders List' ),
            'list_description'      =>  __( 'Display all orders.' ),
            'no_entry'              =>  __( 'No orders has been registered' ),
            'create_new'            =>  __( 'Add a new order' ),
            'create_title'          =>  __( 'Create a new order' ),
            'create_description'    =>  __( 'Register a new order and save it.' ),
            'edit_title'            =>  __( 'Edit order' ),
            'edit_description'      =>  __( 'Modify  Order.' ),
            'back_to_list'          =>  __( 'Return to Orders' ),
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
                // 'name'          =>  'name',
                // 'value'         =>  $entry->name ?? '',
                'description'   =>  __( 'Provide a name to the resource.' )
            ],
            'tabs'  =>  [
                'general'   =>  [
                    'label'     =>  __( 'General' ),
                    'fields'    =>  [
                        [
                            'type'  =>  'text',
                            'name'  =>  'author',
                            'label' =>  __( 'Author' ),
                            'value' =>  $entry->author ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'change',
                            'label' =>  __( 'Change' ),
                            'value' =>  $entry->change ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'code',
                            'label' =>  __( 'Code' ),
                            'value' =>  $entry->code ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'created_at',
                            'label' =>  __( 'Created_at' ),
                            'value' =>  $entry->created_at ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'customer_id',
                            'label' =>  __( 'Customer_id' ),
                            'value' =>  $entry->customer_id ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'delivery_status',
                            'label' =>  __( 'Delivery_status' ),
                            'value' =>  $entry->delivery_status ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'description',
                            'label' =>  __( 'Description' ),
                            'value' =>  $entry->description ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'discount',
                            'label' =>  __( 'Discount' ),
                            'value' =>  $entry->discount ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'discount_rate',
                            'label' =>  __( 'Discount_rate' ),
                            'value' =>  $entry->discount_rate ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'discount_type',
                            'label' =>  __( 'Discount_type' ),
                            'value' =>  $entry->discount_type ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'gross_total',
                            'label' =>  __( 'Gross_total' ),
                            'value' =>  $entry->gross_total ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'id',
                            'label' =>  __( 'Id' ),
                            'value' =>  $entry->id ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'net_total',
                            'label' =>  __( 'Net_total' ),
                            'value' =>  $entry->net_total ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'payment_status',
                            'label' =>  __( 'Payment_status' ),
                            'value' =>  $entry->payment_status ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'process_status',
                            'label' =>  __( 'Process_status' ),
                            'value' =>  $entry->process_status ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'shipping',
                            'label' =>  __( 'Shipping' ),
                            'value' =>  $entry->shipping ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'shipping_rate',
                            'label' =>  __( 'Shipping_rate' ),
                            'value' =>  $entry->shipping_rate ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'shipping_type',
                            'label' =>  __( 'Shipping_type' ),
                            'value' =>  $entry->shipping_type ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'tendered',
                            'label' =>  __( 'Tendered' ),
                            'value' =>  $entry->tendered ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'title',
                            'label' =>  __( 'Title' ),
                            'value' =>  $entry->title ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'total',
                            'label' =>  __( 'Total' ),
                            'value' =>  $entry->total ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'type',
                            'label' =>  __( 'Type' ),
                            'value' =>  $entry->type ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'updated_at',
                            'label' =>  __( 'Updated_at' ),
                            'value' =>  $entry->updated_at ?? '',
                        ], [
                            'type'  =>  'text',
                            'name'  =>  'uuid',
                            'label' =>  __( 'Uuid' ),
                            'value' =>  $entry->uuid ?? '',
                        ],                     ]
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
    public function filterPutInputs( $inputs, Order $entry )
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
        return $request;
    }

    /**
     * After saving a record
     * @param  Request $request
     * @param  Order $entry
     * @return  void
     */
    public function afterPost( $request, Order $entry )
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
        if ( $namespace == 'ns.orders' ) {
            /**
             *  Perform an action before deleting an entry
             *  In case something wrong, this response can be returned
             *
             *  return response([
             *      'status'    =>  'danger',
             *      'message'   =>  __( 'You\re not allowed to do that.' )
             *  ], 403 );
            **/
        }
    }

    /**
     * Define Columns
     * @return  array of columns configuration
     */
    public function getColumns() {
        return [
            'code'  =>  [
                'label'  =>  __( 'Code' ),
                '$direction'    =>  '',
                '$sort'         =>  false
            ],
            'nexopos_customers_name'  =>  [
                'label'         =>  __( 'Customer' ),
                '$direction'    =>  '',
                '$sort'         =>  false
            ],
            'discount'  =>  [
                'label'  =>  __( 'Discount' ),
                '$direction'    =>  '',
                '$sort'         =>  false
            ],
            'delivery_status'  =>  [
                'label'  =>  __( 'Delivery Status' ),
                '$direction'    =>  '',
                '$sort'         =>  false
            ],
            'payment_status'  =>  [
                'label'  =>  __( 'Payment Status' ),
                '$direction'    =>  '',
                '$sort'         =>  false
            ],
            'process_status'  =>  [
                'label'  =>  __( 'Process Status' ),
                '$direction'    =>  '',
                '$sort'         =>  false
            ],
            'total'  =>  [
                'label'  =>  __( 'Total' ),
                '$direction'    =>  '',
                '$sort'         =>  false
            ],
            'type'  =>  [
                'label'  =>  __( 'Type' ),
                '$direction'    =>  '',
                '$sort'         =>  false
            ],
            'nexopos_users_username'  =>  [
                'label'  =>  __( 'Author' ),
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

    public function hook( $query )
    {
        if ( empty( request()->query( 'direction' ) ) ) {
            $query->orderBy( 'id', 'desc' );
        }
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

        $entry->total           =   ns()->currency->define( $entry->total )
            ->format( $entry->total );
        $entry->discount           =   ns()->currency->define( $entry->discount )
            ->format( $entry->discount );

        switch( $entry->type ) {
            case 'delivery' : $entry->type = __( 'Delivery' ); break;
            case 'takeaway' : $entry->type = __( 'Take Away' ); break;
        }

        switch( $entry->delivery_status ) {
            case 'pending' : $entry->delivery_status       = __( 'Pending' ); break;
            case 'ongoing' : $entry->delivery_status       = __( 'Ongoing' ); break;
            case 'delivered' : $entry->delivery_status     = __( 'Delivered' ); break;
            case 'failed' : $entry->delivery_status        = __( 'Failed' ); break;
        }

        switch( $entry->process_status ) {
            case 'pending' : $entry->process_status       = __( 'Pending' ); break;
            case 'ongoing' : $entry->process_status       = __( 'Ongoing' ); break;
            case 'delivered' : $entry->process_status     = __( 'Delivered' ); break;
            case 'failed' : $entry->process_status        = __( 'Failed' ); break;
        }

        switch( $entry->payment_status ) {
            case 'paid' : 
                $entry->payment_status              = __( 'Paid' ); 
                $entry->{ '$cssClass' }             =   'bg-green-100 border-green-200 border text-sm';
            break;
            case 'unpaid' : 
                $entry->payment_status            = __( 'Unpaid' ); 
                $entry->{ '$cssClass' }             =   'bg-red-100 border-red-200 border text-sm';
            break;
            case 'partially_paid' : 
                $entry->payment_status    = __( 'Partially paid' ); 
                $entry->{ '$cssClass' }             =   'bg-yellow-100 border-yellow-200 border text-sm';
            break;
        }

        // you can make changes here
        $entry->{'$actions'}    =   [
            [
                'label'         =>      '<i class="las la-cogs"></i> ' . __( 'Options' ),
                'namespace'     =>      'ns.order-options',
                'type'          =>      'POPUP',
                'url'           =>      url( '/dashboard/' . 'orders' . '/edit/' . $entry->id )
            ], [
                'label'         =>      '<i class="las la-file-invoice-dollar"></i> ' . __( 'Invoice' ),
                'namespace'     =>      'edit',
                'type'          =>      'GOTO',
                'url'           =>      url( '/dashboard/' . 'orders' . '/invoice/' . $entry->id )
            ], [
                'label'         =>      '<i class="las la-receipt"></i> ' . __( 'Receipt' ),
                'namespace'     =>      'edit',
                'type'          =>      'GOTO',
                'url'           =>      url( '/dashboard/' . 'orders' . '/invoice/' . $entry->id )
            ], [
                'label'     =>  '<i class="las la-trash"></i> ' . __( 'Delete' ),
                'namespace' =>  'delete',
                'type'      =>  'DELETE',
                'url'       =>  url( '/api/nexopos/v4/crud/ns.orders/' . $entry->id ),
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
                if ( $entity instanceof Order ) {
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
            'list'      =>  'ns.orders',
            'create'    =>  'ns.orders/create',
            'edit'      =>  'ns.orders/edit/#'
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
                'url'           =>  route( 'crud.bulk-actions', [
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