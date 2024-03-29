<?php

use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\FacilityController;
use App\Http\Controllers\API\FeedbackController;
use App\Http\Controllers\API\MoreFacilityController;
use App\Http\Controllers\API\OrderProductController;
use App\Http\Controllers\API\OrderVenueController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\PromoController;
use App\Http\Controllers\API\QnAController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VenueController;
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
// Routes Global (guests)
Route::get('/', function () {
  return view('welcome');
})->name('welcome');
Route::get('/venue/{id}', [VenueController::class, 'detail'])->name('venuedetail');
Route::get('/product/{id}', [ProductController::class, 'detail'])->name('productdetail');

Route::get('/morefacilities', [MoreFacilityController::class, 'index']);

Route::get('/VenueGetList', [VenueController::class, 'getList']);
Route::get('/Venue/{id}', [VenueController::class, 'show']);

Route::get('/ProductGetList', [ProductController::class, 'getList']);
Route::get('/Product/{id}', [ProductController::class, 'show']);

Route::get('/PromoGetList', [PromoController::class, 'getList']);
Route::get('/PromoGetData/{id}', [PromoController::class], 'show');

// Routes Login Admin
Route::get('/login', 'App\Http\Controllers\Auth\AuthUserAdmin@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\AuthUserAdmin@login')->name('login');

// Routes group for Admin
Route::group(['middleware' => 'auth:web'], function () {
  // [Dashboard]
  Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
  // [User Management Menu]
  Route::get('/users', 'App\Http\Controllers\API\UserController@index')->name('users');
  Route::get('/customers', 'App\Http\Controllers\API\CustomerController@index')->name('customers');
  // [Layanan Menu]
  // Routes Venue (Direct & API)
  Route::get('/Venue', [VenueController::class, 'index'])->name('venues');
  Route::get('/VenueSelectList', [VenueController::class, 'getSelectList']);
  Route::post('/Venue', [VenueController::class, 'store']);
  Route::put('/Venue', [VenueController::class, 'update']);
  Route::delete('/Venue', [VenueController::class, 'destroy']);
  Route::put('/VenuePhoto', [VenueController::class, 'updatePhoto']);
  Route::delete('/VenuePhoto', [VenueController::class, 'destroyPhoto']);
  // Routes Product (Direct & API)
  Route::get('/Product', [ProductController::class, 'index'])->name('products');
  Route::get('/ProductSelectList', [ProductController::class, 'getSelectList']);
  Route::post('/Product', [ProductController::class, 'store']);
  Route::put('/Product', [ProductController::class, 'update']);
  Route::delete('/Product', [ProductController::class, 'destroy']);
  Route::put('/ProductPhoto', [ProductController::class, 'updatePhoto']);
  Route::delete('/ProductPhoto', [ProductController::class, 'destroyPhoto']);
  // Route Promo Page
  Route::get('/Promo', [PromoController::class, 'index'])->name('promo');
  // [Order & Feedback Menu]
  // Route OrderVenue Page (Direct)
  Route::get('/OrderVenue', [OrderVenueController::class, 'index']);
  // Route OrderProduct Page (Direct)
  Route::get('/OrderProduct', [OrderProductController::class, 'index']);
  // Route Feedback Page (Direct)
  Route::get('/Feedback', [FeedbackController::class, 'index']);
  // Admin Profile Routes (API)
  Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
  Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
  Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
  Route::get('/Customer/{id}', [CustomerController::class, 'show']);
  Route::delete('/Customer/{id}', [CustomerController::class, 'destroy']);
  // Route Logout Admin (Direct)
  Route::post('/logout', 'App\Http\Controllers\Auth\AuthUserAdmin@logout')->name('logout');

  // Route group API Resources (CRUD)
  Route::apiResources([
    'Facility' => FacilityController::class,
    'MoreFacility' => MoreFacilityController::class,
    'Promo' => PromoController::class,
    'User' => UserController::class,
    'OrderVenue' => OrderVenueController::class,
    'OrderProduct' => OrderProductController::class,
    'Feedback' => FeedbackController::class,
    'QnA' => QnAController::class
  ]);
});

// Route SignUp Customer (API)
Route::post('/Customer/signup', [CustomerController::class, 'store']);
// Route SignIn Customer (API)
Route::post('/Customer/signin', 'App\Http\Controllers\Auth\AuthCustomerController@login');
// Route Reset Password Customer (API)
Route::post('/Customer/reset-pw', 'App\Http\Controllers\Auth\AuthCustomerController@resetPass');
// Route Cek Available for Venue (API)
Route::post('/CheckVenue', [OrderVenueController::class, 'checkAvailable']);
// Route CS Reviews (API)
Route::get('/Reviews', [FeedbackController::class, 'get3BestReview']);

// Routes group for Customer
Route::group(['middleware' => 'auth:customer'], function () {
  Route::get('/myorder', function () {
    return view('customers.myorder');
  })->name('myorder');
  // Routes Order Venue (API)
  Route::get('/VenueOrderGetListById', [OrderVenueController::class, 'getList']);
  Route::get('/VenueOrder/{id}', [OrderVenueController::class, 'show']);
  Route::post('/VenueOrder', [OrderVenueController::class, 'store']);
  // Routes Order Product (API)
  Route::get('/ProductOrderGetListById', [OrderProductController::class, 'getList']);
  Route::get('/ProductOrder/{id}', [OrderProductController::class, 'show']);
  Route::post('/ProductOrder', [OrderProductController::class, 'store']);
  // Route SignOut Customer (API)
  Route::post('/Customer/signout', 'App\Http\Controllers\Auth\AuthCustomerController@logout');
  // Route Feedback Customer (API)
  Route::get('/CustomerReview', [FeedbackController::class, 'getCsFeedback']);
  // Route group API Resources (CRUD)
  Route::apiResources([
    'Review' => FeedbackController::class
  ]);
});
