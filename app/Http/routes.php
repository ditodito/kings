<?php
Route::get('/', 'QuestionController@index');
Route::get('questions/{id?}', 'QuestionController@index');
Route::post('questions/save', 'QuestionController@save');
Route::delete('question/{question}', 'QuestionController@delete');

Route::get('testing', 'TestingController@index');
Route::post('testing/save', 'TestingController@save');
Route::get('testing/reset', 'TestingController@reset');
Route::get('testing/export', 'TestingController@export');
