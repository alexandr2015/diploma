<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'middleware' => 'auth',
], function () {

    Route::get('question/{id}', [
        'as' => 'question.show',
        'uses' => 'QuestionController@show'
    ]);
    Route::post('save_response/{id}', [
        'as' => 'question.save_response',
        'uses' => 'QuestionController@saveQuestionResponse'
    ]);
});

Route::auth();

Route::get('/home', 'HomeController@index');
