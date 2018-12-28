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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', 'HomeController@index')->name('home');
// Main routes
Route::resource('airports', 'AirportController');
Route::resource('flights', 'FlightController');
Route::resource('insurances', 'InsuranceController');
Route::resource('packages', 'PackageController');
Route::resource('passengers', 'PassengerController');
Route::resource('paymentmethods', 'PaymentMethodController');
Route::resource('permissions', 'PermissionController');
Route::resource('receipts', 'ReceiptController');
Route::resource('reservations', 'ReservationController');
Route::resource('roles', 'RoleController');
Route::resource('seats', 'SeatController');
Route::resource('tickets', 'TicketController');
Route::resource('users', 'UserController');
Route::resource('vehicles', 'VehicleController');
Route::resource('registers', 'RegisterController');
Route::resource('hotels', 'HotelController');
Route::resource('cities', 'CityController');

Route::get('/hotel/{hotel_id}/rooms', 'HotelController@showRooms');
Route::get('/hotel/{hotel_id}/reservations', 'HotelController@showReservatedRooms');
Route::get('/hotel/{hotel_id}/available_rooms/{date}', 'HotelController@showAvailableRooms');
Route::get('/cities/{city_id}/available_flights', 'CityController@showAvailableFlights');
Route::get('/packages/{packageId}/details', 'PackageController@showDetail');
Route::get('/users/{userId}/receipts/{receiptId}/payment_method',
'ReceiptController@showPaymentMethod');
Route::get('/users/{userId}/receipts/{receiptId}/reservation',
'ReceiptController@showReservation');
Route::get('/users/{id}/receipts', 'UserController@showReceipts');
Route::get('/reservations/{reservation_id}/detail', 'ReservationController@showDetail');
