<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix' => 'student'
], function () {
    Route::get('/', [
        'as' => 'student.index',
        'uses' => 'StudentController@index',
    ]);

    Route::get('/{id}', [
        'as' => 'student.show',
        'uses' => 'StudentController@show',
    ]);

    Route::post('/ajax/{user_id}/{question_id}', [
        'as' => 'student.show.getDataForChart',
        'uses' => 'StudentController@getDataForChart',
    ]);
});
