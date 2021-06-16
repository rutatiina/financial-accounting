<?php

namespace Rutatiina\FinancialAccounting\Traits;

use Illuminate\Support\Facades\Auth;
use Rutatiina\FinancialAccounting\Models\Forex\OpenExchangeRate;
use Rutatiina\Tenant\Traits\TenantTrait;

trait Forex
{

    protected static $only_instance;
    public static $api = 'open_exchange_rate';

    public function __construct()
    {}

    protected static function getSelf()
    {
        if (static::$only_instance === null)
        {
            static::$only_instance = new Account;
        }
        return static::$only_instance;
    }

    public static function api($api)
    {
        static::$api = $api;
        return static::getself();
    }

    public static function exchangeRate($base_currency, $quote_currency)
    {

        if ($base_currency == $quote_currency) {
            return 1;
        }

        if (static::$api == 'open_exchange_rate') {

            $openExchangeRate = OpenExchangeRate::latest()->first();

            if ($openExchangeRate) {

                $openExchangeRate->rates = json_decode($openExchangeRate->rates, true);

                if (isset($openExchangeRate->rates[$base_currency]) && isset($openExchangeRate->rates[$quote_currency])) {

                    $rate = $openExchangeRate->rates[$openExchangeRate->base] * $openExchangeRate->rates[$quote_currency]; //Rate quote currency to base
                    $rate = ($rate / $openExchangeRate->rates[$base_currency]);

                    //print_r($rate);

                    return $rate;
                } else {
                    return 0;
                }

            } else {
                return false;
            }

        } else {
            return false;
        }
    }

    public static function convert($amount, $base_currency, $quote_currency)
    {
        $exchangeRate = static::exchangeRate($base_currency, $quote_currency);

        if($exchangeRate) {
            return ($exchangeRate*$amount);
        } else {
            return false;
        }
    }

    public static function contactExchangeRate($contact)
    {
        $exchangeRates = [];
        //$exchangeRates[$contact->currency] = static::exchangeRate($contact->currency, Auth::user()->tenant->base_currency);
        foreach ($contact->currencies as $currency) {
            $exchangeRate = static::exchangeRate($currency, Auth::user()->tenant->base_currency);
            $exchangeRates[$currency] = round($exchangeRate, 5);
        }
        //print_r($exchangeRates); exit;
        return $exchangeRates;
    }

    public static function exchangeRates($currencies, $tenantBaseCurrency)
    {
        $exchangeRates = [];
        //$exchangeRates[$contact->currency] = static::exchangeRate($contact->currency, Auth::user()->tenant->base_currency);
        foreach ($currencies as $currency) {
            $exchangeRate = static::exchangeRate($currency, $tenantBaseCurrency);
            $exchangeRates[$currency] = round($exchangeRate, 5);
        }
        //print_r($exchangeRates); exit;
        return $exchangeRates;
    }

}
