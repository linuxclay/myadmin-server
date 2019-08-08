<?php

Route::prefix('ping')->group(function ()
{
    Route::get('/', 'ExampleController@pong');
    Route::get('/test', 'ExampleController@test');
});
