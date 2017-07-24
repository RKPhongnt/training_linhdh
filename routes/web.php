<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware'=>'locale','prefix'=>Session::get('locale')], function(){
	Route::get('/', 'HomeController@index');

	Auth::routes();

	Route::get('/home', 'HomeController@index')->name('home');

	Route::prefix('admin')->group(function () {
		Route::get('/','admin\UsersController@index')->name('adminHome');
		Route::resource('users', 'admin\UsersController');
		Route::resource('divisions', 'admin\DivisionsController');
		Route::post('passwordReset', 'admin\ResetPasswordController@resetPassword')->name('passwordReset');
		Route::get('exportExcelAllUser','admin\ExcelController@exportExcelAllUser')->name('exportExcelAllUser');
		Route::get('exportExcelUserInDivision/{id}','admin\ExcelController@exportExcelUserInDivision')->name('exportExcelUserInDivision');
		Route::get('user-in-divisions/{id}','admin\UsersController@displayAlowDivision');
		Route::post('searchUser','admin\UsersController@searchUser')->name('serachUser');
	});


	Route::resource('divisions','DivisionsController',['only'=>['index','show']]);
	Route::resource('users','UsersController',['except='=>['create','store','destroy','updateDivision']]);
	Route::post('/search','DivisionsController@search')->name('search');
	Route::post('users/{id}/update','UsersController@updateDivision');
	Route::get('changePassword/{id}','UsersController@getChangePassword')->name('changePassword');
	Route::post('changePassword/{id}','UsersController@updatePassword');
	Route::post('delete-user-in-division/{id}','DivisionsController@deleteUser')->name('deleteUserInDivison');
	Route::post('/lang', [
        'as' => 'switchLang',
        'uses' => 'LangController@changeLang',
     ]);
});
