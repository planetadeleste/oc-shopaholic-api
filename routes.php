<?php

use PlanetaDelEste\ApiShopaholic\Plugin;
use Tymon\JWTAuth\Middleware\GetUserFromToken;

Route::prefix('api/v1')
    ->namespace('PlanetaDelEste\ApiShopaholic\Controllers\Api')
    ->middleware('web')
    ->group(
        function () {

            Route::prefix('categories')
                ->name('categories.')
                ->group(plugins_path(Plugin::API_ROUTES.'categories.php'));

            Route::prefix('products')
                ->name('products.')
                ->group(plugins_path(Plugin::API_ROUTES.'products.php'));

            Route::prefix('cart')
                ->name('cart.')
                ->group(plugins_path(Plugin::API_ROUTES.'cart.php'));

            Route::prefix('orders')
                ->name('orders.')
                ->group(plugins_path(Plugin::API_ROUTES.'orders_public.php'));

            // AUTHENTICATE
            Route::prefix('auth')
                ->name('auth.')
                ->group(plugins_path(Plugin::API_ROUTES.'auth.php'));

            // TRANSLATE
            Route::prefix('lang')
                ->name('lang.')
                ->group(plugins_path(Plugin::API_ROUTES.'lang.php'));

            Route::apiResources(
                [
                    'categories' => 'Categories',
                    'products'   => 'Products'
                ]
            );

            Route::group(
                ['middleware' => GetUserFromToken::class],
                function () {
                    Route::prefix('orders')->group(plugins_path(Plugin::API_ROUTES.'orders.php'));
                    Route::prefix('profile')->group(plugins_path(Plugin::API_ROUTES.'profile.php'));

                    Route::apiResources(
                        [
                            'profile' => 'Profile',
                            'orders'  => 'Orders'
                        ]
                    );
                }
            );
        }
    );
