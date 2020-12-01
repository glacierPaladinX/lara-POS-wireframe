<?php

namespace App\Providers;

use App\Crud\CouponCrud;
use App\Crud\CustomerCrud;
use App\Crud\CustomerGroupCrud;
use App\Crud\CustomerOrderCrud;
use App\Crud\ExpenseCategoryCrud;
use App\Crud\ExpenseCrud;
use App\Crud\ExpenseHistoryCrud;
use App\Crud\HoldOrderCrud;
use App\Crud\OrderCrud;
use App\Crud\PartiallyPaidOrderCrud;
use App\Crud\ProviderCrud;
use App\Crud\RewardSystemCrud;
use App\Crud\UnitCrud;
use App\Crud\UnitGroupCrud;
use App\Crud\ProductCategoryCrud;
use App\Crud\ProductCrud;
use App\Crud\TaxCrud;
use App\Crud\TaxesGroupCrud;
use App\Crud\UserCrud;
use App\Crud\ProcurementCrud;
use App\Crud\ProductHistoryCrud;
use App\Crud\ProductUnitQuantitiesCrud;
use App\Crud\RegisterCrud;
use App\Crud\RolesCrud;
use App\Crud\UnpaidOrderCrud;
use App\Models\ExpenseHistory;
use Illuminate\Support\ServiceProvider;
use TorMorten\Eventy\Facades\Events as Hook;

class CrudServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * every crud class on the system should be
         * added here in order to be available and supported.
         */
        Hook::addFilter( 'ns.crud-resource', function( $namespace ) {
            switch( $namespace ) {
                case 'ns.orders': return OrderCrud::class;
                case 'ns.hold-orders': return HoldOrderCrud::class;
                case 'ns.unpaid-orders': return UnpaidOrderCrud::class;
                case 'ns.partially-paid-orders': return PartiallyPaidOrderCrud::class;
                case 'ns.coupons': return CouponCrud::class;
                case 'ns.customers': return CustomerCrud::class;
                case 'ns.customers-groups': return CustomerGroupCrud::class;
                case 'ns.customers-orders': return CustomerOrderCrud::class;
                case 'ns.customers-coupons': return CustomerCouponCrud::class;
                case 'ns.rewards-system': return RewardSystemCrud::class;
                case 'ns.providers': return ProviderCrud::class;
                case 'ns.expenses-categories': return ExpenseCategoryCrud::class;
                case 'ns.expenses-history': return ExpenseHistoryCrud::class;
                case 'ns.expenses': return ExpenseCrud::class;
                case 'ns.units-groups': return UnitGroupCrud::class;
                case 'ns.units': return UnitCrud::class;
                case 'ns.products': return ProductCrud::class;
                case 'ns.products-categories': return ProductCategoryCrud::class;
                case 'ns.products-units': return ProductUnitQuantitiesCrud::class;
                case 'ns.products-histories': return ProductHistoryCrud::class;
                case 'ns.taxes': return TaxCrud::class;
                case 'ns.taxes-groups': return TaxesGroupCrud::class;
                case 'ns.users': return UserCrud::class;
                case 'ns.registers': return RegisterCrud::class;
                case 'ns.procurements': return ProcurementCrud::class;
                case 'ns.roles': return RolesCrud::class;
            }
            return $namespace;
        });
    }
}
