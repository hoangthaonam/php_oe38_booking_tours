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

Route::group([
    'prefix'=>'admin',
    'namespace'=>'Admin',
    'as' => 'admin.',
],function(){
    Route::get('login', 'LoginController@index')->name('showlogin');
    Route::post('login', 'LoginController@login')->name('login');
    Route::group([ 'middleware' => 'check_admin'], function(){
        Route::get('logout' , 'LoginController@logout')->name('logout');
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::resource('tour', 'TourController');
        Route::resource('/category','CategoryController');
        Route::resource('/payment','PaymentController');
        Route::get('/chart', 'ChartController@index')->name('chart');
    });
    
});
Route::group(['namespace'=>'User'], function(){
    Route::get('login', 'LoginController@index')->name('showlogin');
    Route::post('login', 'LoginController@login')->name('login'); 
    Route::get('home', 'HomeController@index')->name('home.index');
    Route::get('logout', 'LoginController@logout')->name('logout');
    Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
    Route::get('/callback/{provider}', 'SocialController@callback');

    Route::get('/tour/index', 'TourController@index')->name('user.tour.index');
    Route::get('/tour/show/{id}', 'TourController@show')->name('user.tour.show');

    Route::resource('review','ReviewController');
    Route::get('review/create/{id}','ReviewController@createReviews')->middleware('auth')->name('review.createReview');
    Route::post('home/register', 'UserController@registerClient')->name('register');
    Route::resource('user', 'UserController');

    Route::post('comment/create', 'CommentController@create')->middleware('auth')->name('comment.create');
    Route::post('comment/update', 'CommentController@update')->middleware('auth')->name('comment.update');
    Route::delete('comment/destroy', 'CommentController@destroy')->middleware('auth')->name('comment.destroy');

    Route::group(['middleware' => 'auth'], function(){
        Route::resource('booktour','BookTourController');
        Route::get('booking/infor/{id}','BookTourController@displayBookingInformation')->name('booking.infor');

        Route::post('payment/VNPAY', 'PaymentByVNPAYController@create')->name('vnpay.create');
        Route::get('payment/return', 'PaymentByVNPAYController@return')->name('vnpay.return');
        Route::post('payment/normal', 'PaymentController@createNormalPayment')->name('payment.normal');
        Route::get('payment/banking', 'PaymentController@createBankingPayment')->name('payment.banking');
        Route::resource('payment', 'PaymentController');

    });
});

// i18
Route::group(['middleware' => 'locale'], function() {
    Route::get('change-language/{language}', 'changeLanguageController@changeLanguage')
        ->name('user.change-language');
});

Route::get('notification/markAsRead/{id}/{type}', 'NotificationController@markAsRead');
