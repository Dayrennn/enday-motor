<?php

use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\Pelanggan\PelangganController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DataMotorController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AddUserController;
use App\Http\Controllers\Admin\PelangganController as AdminPelangganController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\DataMotorController as ControllersDataMotorController;
use App\Http\Controllers\BookingMotor;
use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});
//Route::get('/produk/honda', function () {
//    return view('produk.honda');
//});
//Route::get('/produk/yamaha', function () {
//    return view('produk.yamaha');
//});
//Route::get('/produk/suzuki', function () {
//    return view('produk.suzuki');
//});
//Route::get('/produk/kawasaki', function () {
//    return view('produk.kawasaki');
//});
//Route::get('/produk/vespa', function () {
//    return view('produk.vespa');
//});
//Route::get('/produk/ktm', function () {
//    return view('produk.ktm');
//});

Route::get('/register', [RegisterController::class, 'showForm'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest')->name('register.post');

//tambah user dari admin
Route::post('/admin/user', [AddUserController::class, 'store'])->name('admin.user.store');

Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

//route untuk contact form
Route::post('/contact/store', [App\Http\Controllers\ContactController::class, 'submitForm'])->name('contact.store');

//route lupa password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request'); //untuk form

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])
    ->name('password.email'); //untuk proses kirim link

//route reset password
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->name('password.update');

//route berdasarkan role
//admin routes
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');
Route::middleware(['auth', 'role:admin'])->get('/admin/user', [UserController::class, 'index'])
    ->name('admin.user'); //agar tidak bentrok dengan route user controller pada bagian menyimpan dan mengupdate user baru
Route::middleware(['auth', 'role:admin'])->get('/admin/penjualan', function () {
    return view('admin.penjualan');
})->name('admin.penjualan');
Route::middleware(['auth', 'role:admin'])->get('/admin/contact', function () {
    return view('admin.contact');
})->name('admin.contact');
Route::middleware(['auth', 'role:admin'])->get('/admin/data-motor', function () {
    return view('admin.data-motor');
})->name('admin.data-motor');

//route admin simpan data motor
Route::prefix('admin')->group(function () {
    Route::get('/data-motor', [DataMotorController::class, 'index'])->name('admin.data-motor');
    Route::post('/data-motor', [DataMotorController::class, 'store'])->name('admin.data-motor.store');
    Route::put('/data-motor/{motor}', [DataMotorController::class, 'update'])->name('admin.data-motor.update');
    Route::delete('/data-motor/{motor}', [DataMotorController::class, 'destroy'])->name('admin.data-motor.destroy');
});
//route untuk menyimpan dan update user baru dari admin
Route::prefix('/admin/users')->name('admin.users.')->middleware(['auth', 'role:admin'])->group(function () { // contoh middleware
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::put('/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
});
// admin update status contact
Route::prefix('admin')->group(function () {
    Route::get('/contact', [ContactController::class, 'index'])->name('admin.contact');
    Route::put('/contact/{contact}/status', [ContactController::class, 'updateStatus'])->name('admin.contact.updateStatus');
    Route::delete('/contact/{contact}', [ContactController::class, 'destroy'])->name('admin.contact.destroy');
});
//penjualan admin
Route::prefix('admin')->middleware('role:admin')->group(function () {
    Route::get('/penjualan', [PenjualanController::class, 'index'])->name('admin.penjualan');
    Route::post('/penjualan', [PenjualanController::class, 'store'])->name('admin.penjualan.store');
    Route::put('/penjualan/{penjualan}', [PenjualanController::class, 'update'])->name('admin.penjualan.update');
    Route::delete('/penjualan/{penjualan}', [PenjualanController::class, 'destroy'])->name('admin.penjualan.destroy');
});
//admin booking dan status
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/booking', [BookingMotor::class, 'index'])->name('admin.booking');
    Route::put('/booking/{id}/status', [BookingMotor::class, 'updateStatus'])
        ->name('admin.booking.updateStatus');
    Route::delete('/booking/{booking}', [BookingMotor::class, 'destroy'])->name('admin.booking.destroy');
});


// route pelanggan
Route::middleware(['auth', 'role:pelanggan'])->group(function () {

    // Dashboard pelanggan booking dan penjualan
    Route::get(
        '/pelanggan/dashboard',
        [PelangganController::class, 'dashboard']
    )->name('pelanggan.dashboard');

    // Booking CRUD
    Route::post('/pelanggan/booking', [BookingMotor::class, 'store'])->name('booking.store');
    Route::put('/pelanggan/booking/{booking}', [BookingMotor::class, 'update'])->name('booking.update');
    Route::delete('/pelanggan/booking/{booking}', [BookingMotor::class, 'destroy'])->name('booking.destroy');

    // Bukti pembayaran
    Route::put('/booking/{id}/upload', [BookingMotor::class, 'uploadBukti'])->name('booking.uploadBukti');

    Route::get('/pelanggan/data-motor', function () {
        return view('pelanggan.data-motor');
    })->name('pelanggan.data-motor');
});
//bukti bayar pelanggan
Route::put('/booking/{id}/upload', [BookingMotor::class, 'uploadBukti'])->name('booking.uploadBukti');


//route sales
Route::middleware(['auth', 'role:sales'])->get('/sales/dashboard', function () {
    return view('sales.dashboard');
})->name('sales.dashboard');
Route::middleware(['auth', 'role:sales'])->get('/sales/penjualan', function () {
    return view('sales.penjualan');
})->name('sales.penjualan');


//route fungsi dashboard sales
Route::get('/sales/dashboard', [SalesController::class, 'index'])->name('sales.dashboard');


//route booking dan status sales
Route::prefix('sales')->middleware(['auth', 'role:sales'])->group(function () {

    Route::get('/booking', [BookingMotor::class, 'index'])->name('sales.booking');
    Route::put('/booking/{id}/status', [BookingMotor::class, 'updateStatus'])
        ->name('sales.booking.updateStatus');
    Route::delete('/booking/{booking}', [BookingMotor::class, 'destroy'])->name('sales.booking.destroy');
});
//route contact sales
Route::prefix('sales')->group(function () {
    Route::get('/contact', [ContactController::class, 'index'])->name('sales.contact');
    Route::put('/contact/{contact}/status', [ContactController::class, 'updateStatus'])->name('sales.contact.updateStatus');
    Route::delete('/contact/{contact}', [ContactController::class, 'destroy'])->name('sales.contact.destroy');
});
//route sales simpan data motor
Route::prefix('sales')->group(function () {
    Route::get('/data-motor', [DataMotorController::class, 'index'])->name('sales.data-motor');
    Route::post('/data-motor', [DataMotorController::class, 'store'])->name('sales.data-motor.store');
    Route::put('/data-motor/{motor}', [DataMotorController::class, 'update'])->name('sales.data-motor.update');
    Route::delete('/data-motor/{motor}', [DataMotorController::class, 'destroy'])->name('sales.data-motor.destroy');
});

//penjualan sales
Route::prefix('sales')->middleware('role:sales')->group(function () {
    Route::get('/penjualan', [PenjualanController::class, 'index'])->name('sales.penjualan');
    Route::post('/penjualan', [PenjualanController::class, 'store'])->name('sales.penjualan.store');
    Route::put('/penjualan/{penjualan}', [PenjualanController::class, 'update'])->name('sales.penjualan.update');
    Route::delete('/penjualan/{penjualan}', [PenjualanController::class, 'destroy'])->name('sales.penjualan.destroy');
});

//route per merek
Route::get('/produk/{brand}', [DataMotorController::class, 'showByBrand'])->name('produk.byBrand');
//route fungsi dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

//route untuk data chart di dashboard
Route::get('admin/chart-data', [DashboardController::class, 'chartData'])->name('admin.chart.data.admin');
Route::get('sales/chart-data', [SalesController::class, 'chartData'])->name('admin.chart.data.sales');
