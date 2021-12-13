<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LocalizationController;

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


Route::get('lang/{locale}', [App\Http\Controllers\LocalizationController::class, 'index']);
/*
    Route::get('user', 'App\Http\Controllers\User\IndexController@index')->name('user.index');

Route::get('user/create', 'App\Http\Controllers\User\IndexController@create')->name('user.create');

Route::post('user/store', 'App\Http\Controllers\User\IndexController@store')->name('user.store');

Route::post('user/destroy', 'App\Http\Controllers\User\IndexController@destroy')->name('user.destroy');

Route::get('user/edit/{user}', 'App\Http\Controllers\User\IndexController@edit')->name('user.edit');

Route::post('user/update', 'App\Http\Controllers\User\IndexController@update')->name('user.update');

 */

    Route::resource('user', App\Http\Controllers\User\IndexController::class);
    //Route::resource('field', App\Http\Controllers\User\FieldController::class);

//справочники
//роли
    Route::get('guide', 'App\Http\Controllers\GuideController@index')->name('guide');
//источники
//Route::get('guide/source', 'App\Http\Controllers\GuideController@source')->name('guide.sources');
//статусы
//Route::get('guide/status', 'App\Http\Controllers\GuideController@status')->name('guide.statuses');
//навыки
//Route::get('guide/skill', 'App\Http\Controllers\GuideController@skill')->name('guide.skills');
//добавление нового
    Route::post('guide/create', 'App\Http\Controllers\GuideController@create')->name('guide.create');
//обновление
    Route::post('guide/update', 'App\Http\Controllers\GuideController@update')->name('guide.update');

//добавление нового
    Route::post('guide/delete', 'App\Http\Controllers\GuideController@destroy')->name('guide.destroy');

//выбор по умолчанию
    Route::post('guide/default', 'App\Http\Controllers\GuideController@default')->name('guide.default');

// список сотрудников
    Route::get('/', 'App\Http\Controllers\User\IndexController@welcome')->name('welcome');
// форма ввода почты для регистрации
    Route::get('invite', 'App\Http\Controllers\Auth\InviteController@form')->name('invite');
    Route::post('invite', 'App\Http\Controllers\Auth\InviteController@mail')->name('invite-mail');


//регистрация
    Route::get('register', 'App\Http\Controllers\Auth\RegisterController@register')->name('register');
    Route::post('register', 'App\Http\Controllers\Auth\RegisterController@create')->name('create');
    Route::get('login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');

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


