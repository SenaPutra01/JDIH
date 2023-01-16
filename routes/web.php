<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\ReportController;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\FooterController;

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

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/home', function () {
        return redirect(Route('dashboard'));
    });
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/getAreaChart/{year}/{ins?}', [DashboardController::class, 'getAreaChart'])->name('dashboard.getAreaChart');
    Route::get('/dashboard/getAreaPie/{year}/{ins?}', [DashboardController::class, 'getAreaPie'])->name('dashboard.getAreaPie');
    
    // START ADMIN PORTAL WEBSITE
    Route::resource('/menu', MenuController::class);
    Route::resource('/halaman', HalamanController::class);
    Route::resource('/berita', BeritaController::class);
    Route::resource('/footer', FooterController::class);
    // END ADMIN PORTAL WEBSITE

    Route::resource('/pengajuan', PengajuanController::class);
    Route::get('/peraturanSub/{id_jenis}', [PengajuanController::class, 'getPeraturanSub'])->name('peraturanSub');
    Route::get('/peraturanSubSyarat/{id_jenis_sub}', [PengajuanController::class, 'getPeraturanSubSyarat'])->name('peraturanSubSyarat');
    Route::get('/noNotaDinas/{tahun_pembuatan}/{id_jenis_sub}', [PengajuanController::class, 'getNoNotaDinas'])->name('noNotaDinas');

    Route::get('/report', [ReportController::class, 'index'])->name('report');
    Route::post('/report', [ReportController::class, 'index'])->name('report');
});

Route::get('/', [FrontendController::class, 'index'])->name('home')->middleware('guest');
Route::get('/pages', [FrontendController::class, 'pages'])->name('pages')->middleware('guest');
Route::get('/page/s/{slug}', [FrontendController::class, 'page'])->name('main.page');

Route::get('/berita/s/{slug}', [BeritaController::class, 'blog'])->name('main.page.blog');
Route::get('/berita/c/{slug}', [BeritaController::class, 'blog_category'])->name('main.page.category');
Route::get('/berita/all', [BeritaController::class, 'blog_all'])->name('main.page.blog_all');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'submit'])->name('login.submit')->middleware('guest');