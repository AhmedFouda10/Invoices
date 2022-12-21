<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerReport;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoicesReport;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\InvoicesArchiveController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\InvoicesAttachmentsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ], function () {
        Route::get('/', function () {
            return view('auth.login');
        });

        // Auth::routes();
        Auth::routes(['register' => false]);
        // معناها اني اقدر امنع حد يعمل New Register وايضا ميقدرش يدخل عليها عن طريق url

        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('invoices', [InvoicesController::class, 'index']);
        Route::get('invoices/add', [InvoicesController::class, 'create']);
        Route::get('section/{id}', [InvoicesController::class, 'getProducts']);
        Route::post('invoices/store', [InvoicesController::class, 'store']);
        Route::get('edit_invoices/{id}', [InvoicesController::class, 'edit']);
        Route::post('invoices/destroy', [InvoicesController::class, 'destroy']);
        Route::post('update_invoice/', [InvoicesController::class, 'update']);
        Route::get('status_invoices/{id}', [InvoicesController::class, 'show'])->name('status_invoices');
        Route::post('invoices/status_update/{id}', [InvoicesController::class, 'status_update'])->name('status_update');
        Route::get('invoice/paid', [InvoicesController::class, 'invoice_paid']);
        Route::get('invoice/unpaid', [InvoicesController::class, 'invoice_unpaid']);
        Route::get('invoice/partialpaid', [InvoicesController::class, 'invoice_partialpaid']);
        Route::get('print_invoices/{id}', [InvoicesController::class, 'print_invoices']);
        Route::get('invoices/export/', [InvoicesController::class, 'export']);
        Route::get('mark/read/all', [InvoicesController::class, 'MarkAsReadAll']);
        Route::post("invoices/archieves/done", [InvoicesController::class, "invoices_archieves_done"]);
        Route::get("invoice/search", [InvoicesController::class, "invoice_search"]);

        Route::get('/invoices_details/{id}', [InvoicesDetailsController::class, 'index']);
        Route::get('view_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'openFile']);
        Route::get('download_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'downloadFile']);
        Route::post('delete_file', [InvoicesDetailsController::class, 'destroy'])->name('delete_file');

        Route::Post('InvoicesAttachments', [InvoicesAttachmentsController::class, 'store']);
        Route::get("invoice/archive", [InvoicesArchiveController::class, "index"]);
        Route::post("invoices/archeive/update", [InvoicesArchiveController::class, "update"]);
        Route::post("invoices/archieve/destroy", [InvoicesArchiveController::class, "destroy"]);

        Route::group(['prefix' => 'sections'], function () {
            Route::get('all', [SectionsController::class, 'index']);
            Route::post('store', [SectionsController::class, 'store']);
            Route::post('update', [SectionsController::class, 'update']);
            Route::post('destroy', [SectionsController::class, 'destroy']);
        });
        Route::group(['prefix' => 'products'], function () {
            Route::get('all', [ProductsController::class, 'index']);
            Route::post('store', [ProductsController::class, 'store']);
            Route::post('update', [ProductsController::class, 'update']);
            Route::post('destroy', [ProductsController::class, 'destroy']);
        });

        Route::group(['middleware' => ['auth']], function () {
            Route::resource('roles', RoleController::class);
            Route::resource('users', UserController::class);

        });

        Route::get("invoices_report", [InvoicesReport::class, 'index']);
        Route::post("search_invoices", [InvoicesReport::class, 'search_invoices']);
        

        Route::get("customer_report", [CustomerReport::class, 'index']);
        Route::post("customer_search", [CustomerReport::class, 'customer_search']);

        // the last route
        Route::get('/{page}', [AdminController::class, 'index']);

    });
