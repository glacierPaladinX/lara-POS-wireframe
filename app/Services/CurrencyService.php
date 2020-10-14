<?php 
namespace App\Services;

use Illuminate\Support\Facades\Log;

class CurrencyService
{
    private $value;

    private $currency_iso;
    private $prefered_currency;
    private $currency_symbol;
    private $format;
    private $decimal_precision;
    private $thousand_separator;
    private $decimal_separator;

    private static $_currency_iso           =   'USD';
    private static $_currency_symbol        =   '$';
    private static $_decimal_precision      =   2;
    private static $_thousand_separator     =   ',';
    private static $_decimal_separator      =   '.';
    private static $_currency_position      =   'before';
    private static $_prefered_currency      =   'iso';

    public function __construct( $value, $config = [])
    {
        $this->value                =   $value;

        extract( $config );

        $this->currency_iso         =   $currency_iso ?? self::$_currency_iso;
        $this->currency_symbol      =   $currency_symbol ?? self::$_currency_symbol;
        $this->currency_position    =   $currency_position ?? self::$_currency_position;
        $this->decimal_precision    =   $decimal_precision ?? self::$_decimal_precision;
        $this->decimal_separator    =   $decimal_separator ?? self::$_decimal_separator;
        $this->prefered_currency    =   $prefered_currency ?? self::$_prefered_currency;
        $this->thousand_separator   =   $thousand_separator ?? self::$_thousand_separator;
    }

    private static function __defineAmount( $amount )
    {
        return app()->make( CurrencyService::class )->value( $amount );
    }

    /**
     * Define an amount to work on
     * @param string
     * @return Currency
     */
    public static function define( $amount )
    {
        return self::__defineAmount( $amount );
    }

    public function value( $amount )
    {
        $this->value    =   $amount;
        return $this;
    }

    public function __toString()
    {
        return $this->format();
    }

    /**
     * Multiply two numbers
     * and return a currency object
     * @param int left operand
     * @param int right operand
     * @return CurrencyService
     */
    public static function multiply( $first, $second )
    {
        return self::__defineAmount( 
            bcmul( floatval( trim( $first ) ), floatval( trim( $second ) ), intval( self::$_decimal_precision ) )
        );
    }

    /**
     * Divide two numbers
     * and return a currency object
     * @param int left operand
     * @param int right operand
     * @return CurrencyService
     */
    public static function divide( $first, $second )
    {
        return self::__defineAmount( 
            bcdiv( floatval( trim( $first ) ), floatval( trim( $second ) ), intval( self::$_decimal_precision ) )
        );
    }

    /**
     * Additionnate two operands
     * @param int left operand
     * @param int right operand
     * @return CurrencyService
     */
    public static function additionate( $left_operand, $right_operand )
    {
        return self::__defineAmount(
            bcadd( floatval( $left_operand ), floatval( $right_operand ), intval( self::$_decimal_precision ) )
        );
    }

    /**
     * calculate a percentage of
     * 2 operand
     * @param int amount
     * @param int percentage
     * @return CurrencyService
     */
    public static function percent( $amount, $rate )
    {
        return self::__defineAmount(
            bcdiv( bcmul( floatval( $amount ), floatval( $rate ), intval( self::$_decimal_precision ) ), 100, intval( self::$_decimal_precision ) )
        );
    }

    /**
     * Define the currency in use
     * on the current process
     * @param string
     * @return Currency
     */
    public function currency( $currency )
    {
        $this->currency     =   $currency;
        return $this;
    }

    /**
     * Get a currency formatted
     * amount of the current Currency Object
     * @return string
     */
    public function format()
    {
        $currency   =   $this->prefered_currency === 'iso' ? $this->currency_iso : $this->currency_symbol;
        $final      =   sprintf( '%s ' . number_format( 
            $this->value, 
            $this->decimal_precision, 
            $this->decimal_separator, 
            $this->thousand_separator 
        ) . ' %s', 
            $this->currency_position === 'before' ? $currency  : '',
            $this->currency_position === 'after' ? $currency : ''
        );

        return $final;
    }

    /**
     * Get the current amount 
     * of the Currency Object
     * @return int|float
     */
    public function get()
    {
        return floatval( $this->value );
    }

    /**
     * Define accuracy of the current
     * Currency object
     * @param int precision number
     * @return CurrencyService
     */
    public function accuracy( $number )
    {
        $this->decimal_precision    =   intval( $number );
        return $this;
    }

    /**
     * Multiply the current Currency value
     * by the provided number
     * @param int number to multiply by
     * @return CurrencyService
     */
    public function multipliedBy( $number )
    {
        $this->value    =   bcmul( floatval( $this->value ), floatval( $number ), $this->decimal_precision );
        return $this;
    }

    /**
     * Multiply the current Currency value
     * by the provided number
     * @param int number to multiply by
     * @return CurrencyService
     */
    public function multiplyBy( $number )
    {
        return $this->multipliedBy( $number );
    }

    /**
     * Divide the current Currency Value
     * by the provided number
     * @param int number to divide by
     * @return CurrencyService
     */
    public function dividedBy( $number )
    {
        $this->value    =   bcdiv( floatval( $this->value ), floatval( $number ), $this->decimal_precision );
        return $this;
    }

    /**
     * Divide the current Currency Value
     * by the provided number
     * @param int number to divide by
     * @return CurrencyService
     */
    public function divideBy( $number )
    {
        return $this->dividedBy( $number );
    }

    /**
     * Subtract the current Currency Value
     * by the provided number
     * @param int number to subtract by
     * @return CurrencyService
     */
    public function subtractBy( $number )
    {
        $this->value    =   bcsub( floatval( $this->value ), floatval( $number ), $this->decimal_precision );
        return $this;
    }

    /**
     * Additionnate the current Currency Value
     * by the provided number
     * @param int number to additionnate by
     * @return CurrencyService
     */
    public function additionateBy( $number )
    {
        $this->value    =   bcadd( floatval( $this->value ), floatval( $number ), $this->decimal_precision );
        return $this;
    }
}