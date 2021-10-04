<?php

use Illuminate\Support\Facades\Route;

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

Route::resource('user', App\Http\Controllers\User\IndexController::class);

Route::resource('field', App\Http\Controllers\User\FieldController::class);

Route::get('/', 'App\Http\Controllers\User\IndexController@welcome')->name('welcome');
// форма ввода почты для регистрации
Route::get('invite', 'App\Http\Controllers\Auth\InviteController@form')->name('invite');
Route::post('invite', 'App\Http\Controllers\Auth\InviteController@mail')->name('invite-mail');

/*
// список сотрудников
Route::get('users', 'App\Http\Controllers\User\IndexController@workers')->name('workers');
// удаление сотрудника
Route::delete('user.destroy', 'App\Http\Controllers\User\IndexController@delete')->name('user.destroy');
// редактирование сотрудника
Route::post('user.edit', 'App\Http\Controllers\User\IndexController@edit')->name('user.edit');
*/
Route::get('register', 'App\Http\Controllers\Auth\RegisterController@register')->name('register');
Route::post('register', 'App\Http\Controllers\Auth\RegisterController@create')->name('create');
Route::get('login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
//Route::get('/', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
// аутентификация
Route::post('login', 'App\Http\Controllers\Auth\LoginController@authenticate')->name('auth');
// выход
Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
// форма ввода адреса почты
Route::get('forgot-password', 'App\Http\Controllers\Auth\ForgotPasswordController@form')->name('forgot-form');
// письмо на почту
Route::post('forgot-password', 'App\Http\Controllers\Auth\ForgotPasswordController@mail')->name('forgot-mail');
// форма восстановления пароля
Route::get(
    'reset-password/token/{token}/email/{email}',
    'App\Http\Controllers\Auth\ResetPasswordController@form'
)->name('reset-form');
// восстановление пароля
Route::post('reset-password', 'App\Http\Controllers\Auth\ResetPasswordController@reset')->name('reset-password');
/*
Route::group([
    'as' => 'auth.', // имя маршрута, например auth.index
    'prefix' => 'auth', // префикс маршрута, например auth/index
], function () {
    // форма регистрации
    Route::get('register', 'Auth\RegisterController@register')
        ->name('register');
    // создание пользователя
    Route::post('register', 'Auth\RegisterController@create')
        ->name('create');
});
*/
