<?php

use App\Http\Controllers\BreachController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OprCustomerAccountController;
use App\Http\Controllers\OprDailyPerformanceController;
use App\Http\Controllers\OprPodDetailController;
use App\Http\Controllers\OprUnDeliveryController;
use App\Http\Controllers\OprUpdatePodController;
use App\Http\Controllers\UserController;
use App\Models\User;
use GuzzleHttp\Middleware;
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

Route::middleware('auth')->get('/', [DashboardController::class, '__invoke']);


Route::prefix('opr')->middleware('auth')->name('opr.')->group(function () {
    Route::prefix('daily-report')->name('daily-report.')->group(function () {
        Route::prefix('oprDailyPerformance')->name('dailyperformance.')->group(function () {

            Route::get('/', [OprDailyPerformanceController::class, 'index'])->middleware(['can:opr daily show'])->name('index'); //opr daily show
            Route::get('/create', [OprDailyPerformanceController::class, 'create'])->middleware(['can:opr daily show'])->name('create'); //opr daily show
            Route::post('/', [OprDailyPerformanceController::class, 'store'])->middleware(['can:opr daily create'])->name('store'); //opr daily create
            Route::get('/{oprDailyPerformance}/edit', [OprDailyPerformanceController::class, 'edit'])->middleware(['can:opr daily show'])->name('edit'); //detail data
            Route::put('/{oprDailyPerformance}', [OprDailyPerformanceController::class, 'update'])->middleware(['can:opr daily edit'])->name('update'); // update edit
            Route::delete('/{oprDailyPerformance}', [OprDailyPerformanceController::class, 'destroy'])->middleware(['can:opr daily delete'])->name('destroy'); //delete data
            Route::get('/export', [OprDailyPerformanceController::class, 'export'])->middleware(['can:opr daily download'])->name('export');
            Route::get('/exportsum', [OprDailyPerformanceController::class, 'exportsum'])->middleware(['can:opr daily download'])->name('exportsum');
            Route::get('/summary', [OprDailyPerformanceController::class, 'summary'])->middleware(['can:opr daily monitoring'])->name('summary');
        });

        Route::prefix('undel')->name('undel.')->group(function () {
            Route::get('/', [OprUnDeliveryController::class, 'index'])->middleware(['can:opr undel show'])->name('index'); //can 'opr undel show'
            Route::get('/create', [OprUnDeliveryController::class, 'create'])->middleware(['can:opr undel create'])->name('create'); // can 'opr undel create'
            Route::post('/', [OprUnDeliveryController::class, 'store'])->middleware(['can:opr undel create'])->name('store'); // can 'opr undel create'
            Route::get('/{oprUnDelivery}/edit', [OprUnDeliveryController::class, 'edit'])->middleware(['can:opr undel create'])->name('edit'); //'can 'opr undel create'
            Route::put('/{oprUnDelivery}', [OprUnDeliveryController::class, 'update'])->middleware(['can:opr undel create'])->name('update'); //'can 'opr undel create'
            Route::put('/{oprUnDelivery}/action', [OprUnDeliveryController::class, 'action'])->middleware(['can:opr undel create'])->name('action'); //'can 'opr undel create'
            Route::delete('/{oprUnDelivery}', [OprUnDeliveryController::class, 'destroy'])->middleware(['can:opr undel delete'])->name('destroy'); //'can 'opr undel delete'
            Route::delete('/{OprUnDeliveriesAction}/action', [OprUnDeliveryController::class, 'actdestroy'])->middleware(['can:opr undel create'])->name('actdestroy'); //'can 'opr undel delete'

        });

        Route::prefix('breach')->name('breach.')->group(function () {
            Route::get('/', [BreachController::class, 'index'])->name('index');
            // Route::get('/create', [BreachController::class, 'create'])->name('create'); //craete tidak di butuhkan agar input breach hanya satu pintu -> penerusan dari undel
            // Route::post('/{breach}', [BreachController::class, 'store'])->name('store'); // lek create ndak ya store juga ndak lah boi
            Route::get('/{breach}/edit', [BreachController::class, 'edit'])->name('edit');
            Route::put('/{breach}', [BreachController::class, 'update'])->name('update');
            Route::delete('/{breach}', [BreachController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('customer')->name('customer.')->group(function () {
            Route::get('/apishow', [OprCustomerAccountController::class, 'apishow'])->name('apishow'); //'opr customer show'
        });


        // kurang download
        Route::prefix('unstatus')->name('unstatus.')->group(function () {
            Route::get('/', [OprUpdatePodController::class, 'index'])->name('index');
            Route::get('/create', [OprUpdatePodController::class, 'create'])->name('create');
            Route::post('/', [OprUpdatePodController::class, 'store'])->name('store');
            Route::get('/{oprUpdatePod}/edit', [OprUpdatePodController::class, 'edit'])->name('edit');
            Route::put('/{oprUpdatePod}', [OprUpdatePodController::class, 'update'])->name('update');
            Route::delete('/{oprUpdatePod}', [OprUpdatePodController::class, 'destroy'])->name('destroy');
            Route::get('/{oprUpdatePod}/download', [OprUpdatePodController::class, 'download'])->name('download');
        });

        Route::prefix('unstatus-detail')->name('unstatus-detail.')->group(function () {
            Route::get('/', [OprPodDetailController::class, 'index'])->name('index');
            Route::get('/create', [OprPodDetailController::class, 'create'])->name('create');
            Route::post('/', [OprPodDetailController::class, 'store'])->name('store');
            Route::get('/{oprPodDetail}/edit', [OprPodDetailController::class, 'edit'])->name('edit');
            Route::put('/{oprPodDetail}', [OprPodDetailController::class, 'update'])->name('update');
            Route::delete('/{oprPodDetail}', [OprPodDetailController::class, 'destroy'])->name('destroy');
            Route::get('/{oprPodDetail}/download', [OprPodDetailController::class, 'download'])->name('download');
        });
    });
});

Route::prefix('su')->name('su.')->middleware(['role:super admin'])->group(function () {
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
    });
});

Route::prefix('mng')->name('mng.')->group(function () {
    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('index');
        Route::get('/import', [EmployeeController::class, 'import'])->name('import');
    });
});
Route::get('/makemesuper', function () {
    return User::find(1)->assignRole('super admin');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

require __DIR__ . '/auth.php';
