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



use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\CheckPointController;
use App\Http\Controllers\Backend\DeliveryOrderController;
use App\Http\Controllers\Backend\DeliveryRouteController;
use App\Http\Controllers\Backend\DriverController;
use App\Http\Controllers\Backend\GoodRecievedController;
use App\Http\Controllers\Backend\InvoicesController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\CarController;
use App\Http\Controllers\Backend\BranchController;
use App\Http\Controllers\Backend\BranchManagerController;



Route::get('/', function () {
	return view('welcome');
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;


Route::get('/', function () {
	return redirect('sign-in');
})->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify');
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('billing', function () {
		return view('pages.billing');
	})->name('billing');
	Route::get('tables', function () {
		return view('pages.tables');
	})->name('tables');
	Route::get('rtl', function () {
		return view('pages.rtl');
	})->name('rtl');
	Route::get('virtual-reality', function () {
		return view('pages.virtual-reality');
	})->name('virtual-reality');
	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	Route::get('user-management', function () {
		return view('pages.laravel-examples.user-management');
	})->name('user-management');
	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');
});

Route::group(['middleware' => 'auth'], function () {

	/** Customer */
	Route::get('/customer', [CustomerController::class, 'index']);
	Route::get('/add-customer', [CustomerController::class, 'create']);
	Route::post('/add-customer', [CustomerController::class, 'store']);
	Route::get('/edit-customer/{id}', [CustomerController::class, 'edit']);
	Route::post('/edit-customer/{id}', [CustomerController::class, 'update']);
	Route::get('/delete-customer/{id}', [CustomerController::class, 'delete']);


	/** Check Point */
	Route::get('/checkpoint', [CheckPointController::class, 'index']);
	Route::get('/add-checkpoint', [CheckPointController::class, 'create']);
	Route::post('/add-checkpoint', [CheckPointController::class, 'store']);
	Route::get('/edit-checkpoint/{id}', [CheckPointController::class, 'edit']);
	Route::post('/edit-checkpoint/{id}', [CheckPointController::class, 'update']);
	Route::get('/delete-checkpoint/{id}', [CheckPointController::class, 'delete']);

	/** Delivery Route */
	Route::get('/delivery-route', [DeliveryRouteController::class, 'index']);
	Route::get('/add-delivery-route', [DeliveryRouteController::class, 'create']);
	Route::post('/add-delivery-route', [DeliveryRouteController::class, 'store']);
	Route::get('/edit-delivery-route/{id}', [DeliveryRouteController::class, 'edit']);
	Route::post('/edit-delivery-route/{id}', [DeliveryRouteController::class, 'update']);
	Route::get('/delete-delivery-route/{id}', [DeliveryRouteController::class, 'delete']);

	Route::get('/check-point-ui/{id}', [DeliveryRouteController::class, 'checkPointUi']);

	/** Delivery Order */
	Route::get('/delivery-order', [DeliveryOrderController::class, 'index']);
	Route::get('/add-delivery-order', [DeliveryOrderController::class, 'create']);
	Route::post('/add-delivery-order', [DeliveryOrderController::class, 'store']);
	Route::get('/view-delivery-order/{id}', [DeliveryOrderController::class, 'show']);
	Route::get('/add-delivery-order-itmes/{id}', [DeliveryOrderController::class, 'addItemsUi']);
	Route::get('/edit-delivery-order/{id}', [DeliveryOrderController::class, 'editOrderUi']);
	Route::post('/edit-delivery-order/{id}', [DeliveryOrderController::class, 'editOrder']);
	Route::get('/delete-delivery-order/{id}', [DeliveryOrderController::class, 'delete']);



	Route::get('/delete-do-item/{id}', [DeliveryOrderController::class, 'deleteDoItem']);

	Route::post('/search-note-item', [DeliveryOrderController::class, 'searchItem']);
	Route::post('/add-note-items', [DeliveryOrderController::class, 'addItems']);


	/** Good Recieved Note */
	Route::get('/good-recieved-note', [GoodRecievedController::class, 'index']);
	Route::get('/add-good-recieved-note', [GoodRecievedController::class, 'create']);
	Route::post('/add-good-recieved-note', [GoodRecievedController::class, 'store']);
	Route::get('/view-good-recieved-note/{id}', [GoodRecievedController::class, 'show']);
	Route::get('/edit-good-recieved-note/{id}', [GoodRecievedController::class, 'edit']);
	Route::post('/edit-good-recieved-note/{id}', [GoodRecievedController::class, 'update']);

	Route::get('/delete-good-recieved-note/{id}', [GoodRecievedController::class, 'deleteNote']);

	Route::get('/delete-good-recieved-item/{id}', [GoodRecievedController::class, 'deleteItem']);
	Route::post('/update-good-recieved-item/{id}', [GoodRecievedController::class, 'updateItem']);
	Route::post('/add-good-recieved-note-item/{id}', [GoodRecievedController::class, 'addNewItemsNote']);

	Route::get('/add-item-ui/{id}', [GoodRecievedController::class, 'addItemUi']);

	/** Driver */
	Route::get('/driver', [DriverController::class, 'index']);
	Route::get('/add-driver', [DriverController::class, 'create']);
	Route::post('/add-driver', [DriverController::class, 'store']);
	Route::get('/edit-driver/{id}', [DriverController::class, 'edit']);
	Route::post('/edit-driver/{id}', [DriverController::class, 'update']);
	Route::get('/delete-driver/{id}', [DriverController::class, 'delete']);

	Route::get('/car-truck', [CarController::class, 'index']);
	Route::get('/add-car-truck', [CarController::class, 'create']);
	Route::post('/add-car-truck', [CarController::class, 'store']);
	Route::get('/edit-car-truck/{id}', [CarController::class, 'edit']);
	Route::post('/edit-car-truck/{id}', [CarController::class, 'update']);
	Route::get('/delete-car-truck/{id}', [CarController::class, 'delete']);


	/** Invoices */
	Route::get('/invoices', [InvoicesController::class, 'index']);
	Route::get('/add-invoices', [InvoicesController::class, 'create']);
	Route::post('/add-invoices', [InvoicesController::class, 'store']);
	Route::get('/edit-invoice/{id}', [InvoicesController::class, 'edit']);
	Route::post('/edit-invoice/{id}', [InvoicesController::class, 'update']);
	Route::get('/view-invoice/{id}', [InvoicesController::class, 'show']);
	Route::get('/add-invoice-itmes/{id}', [InvoicesController::class, 'addItemsUi']);

	Route::get('/delete-invoice/{id}', [InvoicesController::class, 'delete']);
	Route::get('/delete-invoice-item/{id}', [InvoicesController::class, 'deleteItem']);


	Route::post('/add-invoices-items', [InvoicesController::class, 'addItems']);
	Route::post('/search-invoices-note-item', [InvoicesController::class, 'searchItem']);



	/** Reports */
	Route::get('/reports', [ReportController::class, 'index']);

	/** Branch */
	Route::get('/branches', [BranchController::class, 'index']);
	Route::get('/create-branches', [BranchController::class, 'create']);
	Route::post('/create-branches', [BranchController::class, 'store']);
	Route::get('/edit-branch/{id}', [BranchController::class, 'edit']);
	Route::post('/edit-branch/{id}', [BranchController::class, 'update']);
	Route::get('/delete-branch/{id}', [BranchController::class, 'destroy']);

	/** Branch Manger */
	Route::get('/branch-manager', [BranchManagerController::class, 'index']);
	Route::get('/add-branch-manager', [BranchManagerController::class, 'create']);
	Route::post('/add-branch-manager', [BranchManagerController::class, 'store']);
	Route::get('/edit-branch-manager/{id}', [BranchManagerController::class, 'edit']);
	Route::post('/edit-branch-manager/{id}', [BranchManagerController::class, 'update']);
	Route::get('/delete-branch-manager/{id}', [BranchManagerController::class, 'delete']);


});