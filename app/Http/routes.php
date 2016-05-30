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

    Route::get('/ajax/{user_id}/{question_id?}', [
        'as' => 'student.show.getDataForChart',
        'uses' => 'StudentController@getDataForChart',
    ]);
});

Route::group([
    'prefix' => 'question',
], function () {
    Route::get('/', [
        'as' => 'question.index',
        'uses' => 'QuestionController@index',
    ]);

    Route::get('/{question_id}', [
        'as' => 'question.show',
        'uses' => 'QuestionController@show',
    ]);

    Route::get('/get-avg/{question_id}', [
        'as' => 'question.getAvgAllResponses',
        'uses' => 'QuestionController@getAvgAllResponses',
    ]);
});
