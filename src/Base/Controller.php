<?php

/*
|----------------------------------------------------
| Controller                                        |
|----------------------------------------------------
*/

$container['MerchantController'] = function ($container) {
    return new \App\Http\Controllers\API\MerchantController($container);
};

$container['AuthController'] = function ($container) {
    return new \App\Http\Controllers\AuthController($container);
};

$container['DashboardController'] = function ($container) {
    return new \App\Http\Controllers\DashboardController($container);
};

$container['MarketController'] = function ($container) {
    return new \App\Http\Controllers\MarketController($container);
};

$container['TransactionController'] = function ($container) {
    return new \App\Http\Controllers\MarketController($container);
};

$container['BuildingController'] = function ($container) {
    return new \App\Http\Controllers\Merchant\BuildingController($container);
};

$container['OwnerController'] = function ($container) {
    return new \App\Http\Controllers\Merchant\OwnerController($container);
};

$container['PriceController'] = function ($container) {
    return new \App\Http\Controllers\Merchant\PriceController($container);
};

$container['TypeController'] = function ($container) {
    return new \App\Http\Controllers\Merchant\TypeController($container);
};

