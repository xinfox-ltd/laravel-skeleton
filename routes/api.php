<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function (Request $request) {
    return response()->success(['version' => app()->version()]);
});

Route::post('/tokens', [App\Http\Controllers\AuthController::class, 'login']);

Route::controller(App\Http\Controllers\SystemController::class)
    ->prefix('/system')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/menus', 'menuList');
        }
    );

Route::controller(App\Http\Controllers\FileController::class)
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::post('/upload', 'upload');
        }
    );

Route::controller(App\Http\Controllers\EnterpriseController::class)
    ->prefix('/enterprises')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'save');
        }
    );

Route::controller(App\Http\Controllers\ProductController::class)
    ->prefix('/products')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'save');
        }
    );

// 基地
Route::prefix('/bases')
    ->middleware(['auth:sanctum'])
    ->group(function() {
        Route::controller(App\Http\Controllers\ProductionBaseController::class)
            ->group(
                function () {
                    Route::get('/', 'index');
                    Route::post('/', 'save');
                }
            );
        Route::controller(App\Http\Controllers\ProductionBaseItemController::class)
            ->group(
                function () {
                    Route::get('/{baseId}/pieces', 'index');
                    Route::post('/{baseId}/pieces', 'save');
                }
            );
    });


Route::controller(App\Http\Controllers\InputCategoryController::class)
    ->prefix('/input/categories')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'save');
            Route::delete('/{id}', 'delete')->where(['id' => '\d+']);
        }
    );

Route::controller(App\Http\Controllers\DosageFormController::class)
    ->prefix('/dosage/forms')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'save');
        }
    );

Route::controller(App\Http\Controllers\TraceabilityCodeApplicationController::class)
    ->prefix('/traceability/code/applications')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'save');
            Route::delete('/{id}', 'delete')->where(['id' => '\d+']);
            Route::get('/{id}', 'show')->where(['id' => '\d+']);
        }
    );

Route::controller(App\Http\Controllers\CertificateController::class)
    ->prefix('/certificates')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'save');
        }
    );

Route::controller(App\Http\Controllers\UserController::class)
    ->prefix('/users')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'save');
        }
    );

Route::controller(App\Http\Controllers\SupplierController::class)
    ->prefix('/suppliers')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'save');
        }
    );

Route::controller(App\Http\Controllers\InputController::class)
    ->prefix('/inputs')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'save');
            Route::get('/{id}', 'show')->where(['id' => '\d+']);
        }
    );

Route::controller(App\Http\Controllers\PlantingPlanController::class)
    ->prefix('/planting/plans')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'save');
            Route::get('/{id}', 'show')->where(['id' => '\d+']);
        }
    );

Route::controller(App\Http\Controllers\EnterpriseProductController::class)
    ->prefix('/enterprise/products')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'save');
        }
    );

Route::controller(App\Http\Controllers\TrademarkController::class)
    ->prefix('/trademarks')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'save');
        }
    );

Route::controller(App\Http\Controllers\EnterpriseStaffController::class)
    ->prefix('/enterprise/staffs')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'save');
            Route::delete('/{id}', 'delete')->where(['id' => '\d+']);
        }
    );

Route::controller(App\Http\Controllers\PlantingAssignmentController::class)
    ->prefix('/planting/assignments')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'save');
            Route::delete('/{id}', 'delete')->where(['id' => '\d+']);
            Route::get('/{id}/inputs', 'inputList')->where(['id' => '\d+']);
            Route::post('/{id}/inputs', 'saveInput')->where(['id' => '\d+']);
            Route::delete('/{id}/inputs/{iid}', 'destroyInput')->where(['id' => '\d+', 'iid' => '\d+']);
        }
    );

Route::controller(App\Http\Controllers\RawMaterialController::class)
    ->prefix('/raw-materials')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'save');
            Route::get('/{id}', 'show')->where(['id' => '\d+']);
            Route::delete('/{id}', 'delete')->where(['id' => '\d+']);
        }
    );


Route::controller(App\Http\Controllers\HarvestPlanController::class)
    ->prefix('/harvest/plans')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'save');
            Route::get('/{id}', 'show')->where(['id' => '\d+']);
            Route::delete('/{id}', 'delete')->where(['id' => '\d+']);
        }
    );

Route::controller(App\Http\Controllers\ProcessFlowController::class)
    ->prefix('/process/flows')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'save');
            Route::get('/{id}', 'show')->where(['id' => '\d+']);
            Route::delete('/{id}', 'delete')->where(['id' => '\d+']);
        }
    );

Route::controller(App\Http\Controllers\ProcessController::class)
    ->prefix('/processes')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'save');
            Route::get('/{id}', 'show')->where(['id' => '\d+']);
            Route::delete('/{id}', 'delete')->where(['id' => '\d+']);
        }
    );

Route::controller(App\Http\Controllers\PackageController::class)
    ->prefix('/packages')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'save');
            Route::get('/{id}', 'show')->where(['id' => '\d+']);
            Route::delete('/{id}', 'delete')->where(['id' => '\d+']);
        }
    );

Route::controller(App\Http\Controllers\ReportController::class)
    ->prefix('/detection/reports')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'save');
            Route::get('/{id}', 'show')->where(['id' => '\d+']);
            Route::delete('/{id}', 'delete')->where(['id' => '\d+']);
        }
    );

Route::controller(App\Http\Controllers\BaseUnitController::class)
    ->prefix('/base/units')
    ->middleware(['auth:sanctum'])
    ->group(
        function () {
            Route::get('/', 'index');
            Route::post('/', 'save');
            Route::get('/{id}', 'show')->where(['id' => '\d+']);
            Route::delete('/{id}', 'delete')->where(['id' => '\d+']);
        }
    );
