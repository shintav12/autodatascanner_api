<?php

Route::group(['prefix' => 'api'], function (){
    Route::group(['prefix' => '/brands'], function (){
        Route::get('/','BrandController@get')->middleware('cors');
    });

    Route::group(['prefix' => '/systems'], function (){
        Route::get('','SystemController@get')->middleware('cors');
        Route::get('options/{father_slug?}/{system_id?}','SystemController@Options')->middleware('cors');
        Route::get('option/{slug}','SystemController@father')->middleware('cors');
    });

    Route::group(['prefix' => '/cars'], function (){
        Route::get('/{brand_id}','CarController@getYears')->middleware('cors');
        Route::get('/{brand_id}/{year}','CarController@getModels')->middleware('cors');
        Route::get('/{brand_id}/{year}/{model}','CarController@getEngine')->middleware('cors');
        Route::get('/{brand_id}/{year}/{model}/{engine}','CarController@getCar')->middleware('cors');
    });
    Route::group(['prefix' => '/case'], function (){
        Route::get('/','CarController@getCase')->middleware('cors');
    });
    
});

