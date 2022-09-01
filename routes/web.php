<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OprBreachController;
use App\Http\Controllers\OprCustomerAccountController;
use App\Http\Controllers\OprDailyExpressPerformanceController;
use App\Http\Controllers\OprDailyPerformanceController;
use App\Http\Controllers\OprOpenStatusController;
use App\Http\Controllers\OprOpenStatusDetailController;
use App\Http\Controllers\OprUndelController;
use App\Http\Controllers\UserController;
use App\Models\OprDailyExpressPerformance;
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
    Route::prefix('daily-performance')->middleware('auth')->name('dailyperformance.')->group(function () {
        Route::prefix('express')->middleware('auth')->name('express.')->group(function () {
            Route::get('/', [OprDailyExpressPerformanceController::class, 'index'])->middleware(['can:opr dailyperformance read'])->name('index');
            Route::get('/create', [OprDailyExpressPerformanceController::class, 'create'])->middleware(['can:opr dailyperformance read'])->name('create');
            Route::post('/', [OprDailyExpressPerformanceController::class, 'store'])->middleware(['can:opr dailyperformance create'])->name('store');
            Route::get('/{oprDailyExpressPerformance}/edit', [OprDailyExpressPerformanceController::class, 'edit'])->middleware(['can:opr dailyperformance read'])->name('edit');
            Route::put('/{oprDailyExpressPerformance}', [OprDailyExpressPerformanceController::class, 'update'])->middleware(['can:opr dailyperformance create'])->name('update');
            Route::delete('/{oprDailyExpressPerformance}', [OprDailyExpressPerformanceController::class, 'destroy'])->middleware(['can:opr dailyperformance delete'])->name('destroy');
            Route::get('/export', [OprDailyExpressPerformanceController::class, 'export'])->middleware(['can:opr daily download'])->name('export');
        });
        Route::prefix('non-express')->middleware('auth')->name('nonexpress.')->group(function () {
            Route::get('/', [OprDailyPerformanceController::class, 'index'])->middleware(['can:opr dailyperformance read'])->name('index');
            Route::get('/create', [OprDailyPerformanceController::class, 'create'])->middleware(['can:opr dailyperformance read'])->name('create');
            Route::post('/', [OprDailyPerformanceController::class, 'store'])->middleware(['can:opr dailyperformance create'])->name('store');
            Route::get('/{oprDailyPerformance}/edit', [OprDailyPerformanceController::class, 'edit'])->middleware(['can:opr dailyperformance read'])->name('edit');
            Route::put('/{oprDailyPerformance}', [OprDailyPerformanceController::class, 'update'])->middleware(['can:opr dailyperformance create'])->name('update');
            Route::delete('/{oprDailyPerformance}', [OprDailyPerformanceController::class, 'destroy'])->middleware(['can:opr dailyperformance delete'])->name('destroy');
            Route::get('/export', [OprDailyPerformanceController::class, 'export'])->middleware(['can:opr daily download'])->name('export');
        });
        Route::prefix('summary')->middleware('auth')->name('summary.')->group(function () {
            Route::prefix('non-express')->name('nonexpress.')->group(function () {
                Route::get('/', [OprDailyPerformanceController::class, 'summary'])->middleware(['can:opr dailyperformance summary'])->name('index');
                Route::get('/export', [OprDailyPerformanceController::class, 'exportsum'])->middleware(['can:opr daily download'])->name('export');
            });
            Route::prefix('express')->middleware('auth')->name('express.')->group(function () {
                Route::get('/', [OprDailyExpressPerformanceController::class, 'summary'])->middleware(['can:opr dailyperformance summary'])->name('index');
                Route::get('/export', [OprDailyExpressPerformanceController::class, 'exportsum'])->middleware(['can:opr daily download'])->name('export');
            });
        });
    });

    Route::prefix('undel')->middleware('auth')->name('undel.')->group(function () {
        Route::get('/', [OprUndelController::class, 'index'])->middleware(['can:opr undel read'])->name('index');
        Route::get('/create', [OprUndelController::class, 'create'])->middleware(['can:opr undel read'])->name('create');
        Route::post('/', [OprUndelController::class, 'store'])->middleware(['can:opr undel create'])->name('store');
        Route::get('/{oprUndel}/edit', [OprUndelController::class, 'edit'])->middleware(['can:opr undel read'])->name('edit');
        Route::put('/{oprUndel}', [OprUndelController::class, 'update'])->middleware(['can:opr undel create'])->name('update');
        Route::put('/{oprUndel}/action', [OprUndelController::class, 'action'])->middleware(['can:opr undel create'])->name('action');
        Route::put('/{breach}/breach', [OprUndelController::class, 'breach'])->middleware(['can:opr undel create'])->name('breach');
        Route::delete('/{oprUndel}', [OprUndelController::class, 'destroy'])->middleware(['can:opr undel delete'])->name('destroy');
        Route::delete('/{oprUndelAction}/action', [OprUndelController::class, 'actdestroy'])->middleware(['can:opr undel delete'])->name('actdestroy');
        Route::get('/export-main', [OprUndelController::class, 'export'])->middleware(['can:opr undel read'])->name('exportmain');
    });


    Route::prefix('breach')->name('breach.')->group(function () {
        Route::get('/', [OprBreachController::class, 'index'])->middleware(['can:opr undel read'])->name('index');
        Route::get('/create', [OprBreachController::class, 'create'])->middleware(['can:opr undel read'])->name('create');
        Route::post('/', [OprBreachController::class, 'store'])->middleware(['can:opr undel create'])->name('store');
        Route::get('/{oprBreach}/edit', [OprBreachController::class, 'edit'])->middleware(['can:opr undel read'])->name('edit');
        Route::put('/{oprBreach}', [OprBreachController::class, 'update'])->middleware(['can:opr undel create'])->name('update');
        Route::delete('/{oprBreach}', [OprBreachController::class, 'destroy'])->middleware(['can:opr undel delete'])->name('destroy');
        Route::delete('/{oprBreach}/arrival', [OprBreachController::class, 'arrivaldestroy'])->middleware(['can:opr undel delete'])->name('arrivaldestroy');
    });

    Route::prefix('openstatus')->name('openstatus.')->group(function () {
        Route::prefix('unstatus')->name('unstatus.')->group(function () {
            Route::get('/', [OprOpenStatusController::class, 'index'])->middleware(['can:opr unstatus read'])->name('index');
            Route::get('/create', [OprOpenStatusController::class, 'create'])->middleware(['can:opr unstatus read'])->name('create');
            Route::post('/', [OprOpenStatusController::class, 'store'])->middleware(['can:opr unstatus create'])->name('store');
            Route::get('/{oprOpenStatus}/edit', [OprOpenStatusController::class, 'edit'])->middleware(['can:opr unstatus read'])->name('edit');
            Route::put('/{oprOpenStatus}', [OprOpenStatusController::class, 'update'])->middleware(['can:opr unstatus create'])->name('update');
            Route::delete('/{oprOpenStatus}', [OprOpenStatusController::class, 'destroy'])->middleware(['can:opr unstatus delete'])->name('destroy');
            Route::get('/{oprOpenStatus}/download', [OprOpenStatusController::class, 'download'])->middleware(['can:opr unstatus read'])->name('download');
        });
        Route::prefix('detail')->name('detail.')->group(function () {
            Route::get('/', [OprOpenStatusDetailController::class, 'index'])->middleware(['can:opr unstatus read'])->name('index');
            Route::get('/create', [OprOpenStatusDetailController::class, 'create'])->middleware(['can:opr unstatus read'])->name('create');
            Route::post('/', [OprOpenStatusDetailController::class, 'store'])->middleware(['can:opr unstatus create'])->name('store');
            Route::get('/{oprOpenStatusDetail}/edit', [OprOpenStatusDetailController::class, 'edit'])->middleware(['can:opr unstatus read'])->name('edit');
            Route::put('/{oprOpenStatusDetail}', [OprOpenStatusDetailController::class, 'update'])->middleware(['can:opr unstatus create'])->name('update');
            Route::delete('/{oprOpenStatusDetail}', [OprOpenStatusDetailController::class, 'destroy'])->middleware(['can:opr unstatus delete'])->name('destroy');
            Route::get('/{oprOpenStatusDetail}/download', [OprOpenStatusDetailController::class, 'download'])->middleware(['can:opr unstatus read'])->name('download');
        });
    });


    Route::prefix('daily-report')->name('daily-report.')->group(function () {
        Route::prefix('customer')->name('customer.')->group(function () {
            Route::get('/apishow', [OprCustomerAccountController::class, 'apishow'])->name('apishow'); //'opr customer show'
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


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

require __DIR__ . '/auth.php';
