<?php

Route::group(['prefix' => 'api'], function (){
    Route::group(['prefix' => '/brands'], function (){
        Route::get('/','BrandController@get');
    });

    Route::group(['prefix' => '/systems'], function (){
        Route::get('','SystemController@get');
        Route::get('options/{father_slug?}/{system_id?}','SystemController@Options');
        Route::get('option/{slug}','SystemController@father');
    });

    Route::group(['prefix' => '/cars'], function (){
        Route::get('/{brand_id}','CarController@getYears');
        Route::get('/{brand_id}/{year}','CarController@getModels');
        Route::get('/{brand_id}/{year}/{model}','CarController@getEngine');
        Route::get('/{brand_id}/{year}/{model}/{engine}','CarController@getCar');
    });
    Route::group(['prefix' => '/case'], function (){
        Route::get('/','CarController@getCase');
    });
    
});

