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
Route::resource('registers', 'RegisterController');
Route::resource('hotels', 'HotelController');
Route::resource('cities', 'CityController');

// Hotel routes
Route::get('/hotel/{hotel_id}/rooms', 'HotelController@showRooms');
Route::get('/hotel/{hotel_id}/reservations', 'HotelController@showReservatedRooms');
Route::get('/hotel/{hotel_id}/available_rooms/{date}', 'HotelController@showAvailableRooms');
Route::post('/hotel_post', 'HotelController@storeOrUpdate');
// Cities routes
Route::get('/cities/{city_id}/available_flights', 'CityController@showAvailableFlights');
Route::post('/cities_post', 'CityController@storeOrUpdate');

// Package routes
Route::get('/packages/{packageId}/details', 'PackageController@showDetail');
Route::post('/packages_post', 'PackageController@storeOrUpdate');

// Users rotues
Route::get('/users/{userId}/receipts/{receiptId}/payment_method', 'ReceiptController@showPaymentMethod');
Route::get('/users/{userId}/receipts/{receiptId}/reservation', 'ReceiptController@showReservation');
Route::get('/users/{id}/receipts', 'UserController@showReceipts');
Route::post('/users_post', 'UserController@storeOrUpdate');

Route::get('/logout','Auth\LoginController@logout');

// Reservations routes
Route::get('/reservations/{reservation_id}/detail', 'ReservationController@showDetail');
Route::post('/reservations_post', 'ReservationController@storeOrUpdate');


// Flights routes
Route::post('/flights_post', 'FlightController@storeOrUpdate');
Route::get('/flights/{id}/available_seats', 'FlightController@availableSeats');
Route::get('/reserve', 'ReserveController@searchFlights');
Route::post('/reserve/choose_flights', 'ReserveController@chooseFlights');
Route::post('/reserve/storeChosenFlights', 'ReserveController@storeChosenFlights');
Route::get('/reserve/retrievePassengersInfo', 'ReserveController@retrievePassengersInfo');
Route::post('/reserve/storePassengersInfo', 'ReserveController@storePassengersInfo');
Route::get('/reserve/selectSeats', 'ReserveController@selectSeats');
Route::post('/reserve/storeChosenSeats', 'ReserveController@storeChosenSeats');
Route::get('/reserve/summary', 'ReserveController@showSummary');
Route::post('/asociatedSeatType', 'FlightController@asociatedSeatType');
Route::post('/flightsOfCurrentReserve', 'ReserveController@flightsOfCurrentReserve');
Route::post('/passengersOfCurrentReserve', 'ReserveController@passengersOfCurrentReserve');
Route::get('/reserve/pay', 'ReserveController@pay');
Route::post('/reserve/store_payment', 'ReserveController@storePayment');

// FB API Routes
Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/reserve/vehicles', 'VehicleController@searchVehicles');
Route::get('/reserve/hotels', 'HotelController@searchHotels');

// dashboard
Route::get('/dashboard', 'DashboardController@index');
// Reserva de habitacion
Route::get('/reserve/rooms', 'RoomReservationController@searchRooms');
Route::post('/reserve/rooms/chooseRoom', 'RoomReservationController@chooseHotelRoom');
