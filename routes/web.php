<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');
// Products Rautes
// $this->patch('products', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('abilities', 'Admin\AbilitiesController');
    Route::post('abilities_mass_destroy', ['uses' => 'Admin\AbilitiesController@massDestroy', 'as' => 'abilities.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    
    Route::resource('products', 'Admin\ProductController');
    Route::resource('customers', 'Admin\CustomersController');
    Route::resource('orders', 'Admin\OrderController');
	Route::get('viewOrder/{id}', 'Admin\OrderController@view');
});


Route::get('getProductsData/{filter?}', 'Admin\ProductController@getProductsData')->name('getProductsData');
Route::get('getCustomersData', 'Admin\CustomersController@getCustomersData')->name('getCustomersData');
Route::get('getOrdersData', 'Admin\OrderController@getOrdersData')->name('getOrdersData');
Route::get('test', 'Admin\OrderController@test')->name('test');
