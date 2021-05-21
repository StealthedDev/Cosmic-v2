<?php
namespace Library;

use App\Config;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;

class Paypal
{
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }

    public static function environment()
    {
        return new ProductionEnvironment(Config::paypal["paypal_client_id"], Config::paypal["paypal_secret_id"]);
    }
}