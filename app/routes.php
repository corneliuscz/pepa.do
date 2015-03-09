<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route::get('/', ['as' => 'home', 'uses' => 'HomeController@home']);
Route::get('/', function() {
  return View::make('home');
});

Route::get('login', 'SessionsController@create' );
Route::get('logout', 'SessionsController@destroy' );

Route::get('admin', 'QuestionsController@index' )->before('auth');
Route::get('dotazy', 'DiscussionsController@index')->before('auth');
Route::get('diskuze', 'DiscussionsController@create');

Route::get('nactiotazky', function() {
  if(Request::ajax())
    {
      // Načteme publikované otázky (qstatus = 1)
      $questions = Question::getPublicQuestions();
      // Načteme připnuté otázky (qstatus = 4)
      $pinnedQuestions = Question::getPinnedQuestions();
      // Spojíme data do jednoho JSON objektu
      $outputQuestions = json_encode(array_merge(json_decode($questions, true),json_decode($pinnedQuestions, true)));
      // Posuneme odpověď zpátky do stránky
      echo $outputQuestions;
    }
});

Route::resource('sessions', 'SessionsController', ['only' => ['index', 'create', 'destroy', 'store']]);
Route::resource('questions', 'QuestionsController');
Route::resource('dotazy', 'DiscussionsController');
