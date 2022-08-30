<?php

use App\Http\Controllers\BreachController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OprBreachController;
use App\Http\Controllers\OprCustomerAccountController;
use App\Http\Controllers\OprDailyExpressPerformanceController;
use App\Http\Controllers\OprDailyPerformanceController;
use App\Http\Controllers\OprPodDetailController;
use App\Http\Controllers\OprUndelController;
use App\Http\Controllers\OprUnDeliveryController;
use App\Http\Controllers\OprUpdatePodController;
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
            Route::get('/', [OprDailyExpressPerformanceController::class, 'index'])->name('index');
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
        Route::delete('/{oprUndel}', [OprUndelController::class, 'destroy'])->middleware(['can:opr undel delete'])->name('destroy');
        Route::delete('/{oprUndelAction}/action', [OprUndelController::class, 'actdestroy'])->middleware(['can:opr undel delete'])->name('actdestroy');
        Route::get('/export-main', [OprUndelController::class, 'export'])->middleware(['can:opr undel read'])->name('exportmain');
    });


    Route::prefix('breach')->name('breach.')->group(function () {
        Route::get('/', [OprBreachController::class, 'index'])->name('index');
        // Route::get('/create', [BreachController::class, 'create'])->name('create'); //craete tidak di butuhkan agar input breach hanya satu pintu -> penerusan dari undel
        // Route::post('/{oprBreach}', [BreachController::class, 'store'])->name('store'); // lek create ndak ya store juga ndak lah boi
        Route::get('/{oprBreach}/edit', [OprBreachController::class, 'edit'])->name('edit');
        Route::put('/{oprBreach}', [OprBreachController::class, 'update'])->name('update');
        Route::delete('/{oprBreach}', [OprBreachController::class, 'destroy'])->name('destroy');
    });


    Route::prefix('daily-report')->name('daily-report.')->group(function () {


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

Route::prefix('master')->name('master.')->group(function () {
    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('index');
        Route::get('/import', [EmployeeController::class, 'import'])->name('import');
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
