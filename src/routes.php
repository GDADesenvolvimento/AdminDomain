<?php
Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/domains', ['as' => 'domains', 'uses' => 'DomainController@index']);
    Route::get('/domain/form', ['as' => 'domain.form', 'uses' => 'DomainController@form']);
    Route::post('/domain/create', ['as' => 'domain.create', 'uses' => 'DomainController@create']);
    Route::get('/domain/edit/{id}', ['as' => 'domain.edit', 'uses' => 'DomainController@edit']);
    Route::put('/domain/put', ['as' => 'domain.update', 'uses' => 'DomainController@update']);
    Route::get('/domain/delete/{id}', ['as' => 'domain.delete', 'uses' => 'DomainController@delete']);
    Route::post('/domain/consultwhois', ['as' => 'domain.whois', 'uses' => 'DomainController@consultWhois']);
});