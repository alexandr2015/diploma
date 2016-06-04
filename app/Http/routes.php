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
    Route::post('save_response/{question_id}', [
        'as' => 'question.save_response',
        'uses' => 'QuestionController@saveQuestionResponse'
    ]);

    Route::put('update_response/{question_id}', [
        'as' => 'question.update_response',
        'uses' => 'QuestionController@updateQuestionResponse'
    ]);
});

Route::auth();

Route::get('/home', 'HomeController@index');
