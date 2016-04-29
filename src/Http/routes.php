<?php
/**
 * Created by PhpStorm.
 * User: evgeniy
 * Date: 28.04.16
 * Time: 17:40
 */


Route::group(['middleware' => ['OnlyCli']], function () {
    Route::get('pay/exchange', 'reg2005\\PayAssetsLaravel\\Http\\Controllers\\PayAssetsController@index');
});