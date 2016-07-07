<?php
Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/domains', ['as' => 'domains', 'uses' => '\GdaDesenv\AdminDomain\Controllers\DomainController@index']);
    Route::get('/domain/form', ['as' => 'domain.form', 'uses' => '\GdaDesenv\AdminDomain\Controllers\DomainController@form']);
    Route::post('/domain/create', ['as' => 'domain.create', 'uses' => '\GdaDesenv\AdminDomain\Controllers\DomainController@create']);
    Route::get('/domain/edit/{id}', ['as' => 'domain.edit', 'uses' => '\GdaDesenv\AdminDomain\Controllers\DomainController@edit']);
    Route::put('/domain/put', ['as' => 'domain.update', 'uses' => '\GdaDesenv\AdminDomain\Controllers\DomainController@update']);
    Route::get('/domain/delete/{id}', ['as' => 'domain.delete', 'uses' => '\GdaDesenv\AdminDomain\Controllers\DomainController@delete']);
    Route::post('/domain/consultwhois', ['as' => 'domain.whois', 'uses' => '\GdaDesenv\AdminDomain\Controllers\DomainController@consultWhois']);
});