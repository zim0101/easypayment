<?php

Route::get('/test-payment', 'PayWayDev\EasyPayment\Controllers\EasyPayTestController@testEasyPay');
Route::get('/test', function () {
    return 'worked';
});
Route::get('/red', function () {
    return 'worked too';
});
Route::get('/hook', function () {
    return 'worked too';
});
