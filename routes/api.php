<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/import/items', 'ItemController@import');
Route::get('/import/champions', 'ChampionController@import');
Route::get('/import/challengers', 'DetailedMatchInfoController@import');
Route::get('/import/summoners', 'SummonerController@import');
Route::get('/import/accounts', 'SummonerController@accountImport');
Route::get('/import/matches', 'MatchController@import');

Route::get('/import/matches', 'MatchController@import');

Route::get('/import/matches/info', 'MatchInfoController@import');
Route::get('/import/matches/timelines', 'TimelineController@import');
