<?php


use App\Http\Controllers\FloorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\MealsController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RateCodeController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ActivitylogController;
use App\Http\Controllers\MealPackageController;
use App\Http\Controllers\OordServiceController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\OrderServiceController;
use App\Http\Controllers\companyProfileController;
use App\Http\Controllers\SourceBusinessController;
use App\Http\Controllers\CompanyStatementController;
use App\Http\Controllers\Api\V1\Rooms\RoomController;
use App\Http\Controllers\Api\V1\Permission\RoleController;
use App\Http\Controllers\Api\V1\Rooms\RoomChangeController;
use App\Http\Controllers\Api\V1\Subscription\PlanController;
use App\Http\Controllers\Api\V1\Subscription\FeatureController;
use App\Http\Controllers\Api\V1\Permission\PermissionController;
use App\Http\Controllers\Api\v1\Profiles\GuestProfile\ReservationController;
use App\Http\Controllers\Api\V1\Profiles\GuestProfile\GuestInhouseController;
use App\Http\Controllers\Api\V1\Profiles\GuestProfile\GuestProfileController;



Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('user-register', [AuthController::class, 'register']);
    Route::post('user-logout', [AuthController::class, 'logout']);

    Route::resource('categories', CategoryController::class);
    Route::resource('labels', LabelController::class);
    Route::resource('tickets', TicketController::class);
    Route::post('tickets/upload', [TicketController::class, 'upload']);
    Route::post('tickets/{ticket}/close', [TicketController::class, 'close']);
    Route::post('tickets/{ticket}/reopen', [TicketController::class, 'reopen']);
    Route::post('tickets/{ticket}/archive', [TicketController::class, 'archive']);

    Route::resource('settings', SettingsController::class);

    Route::resource('tax', TaxController::class);
    Route::resource('ledger', LedgerController::class);

    Route::resource('activities', ActivitylogController::class);

    Route::resource('meals',MealsController::class);
    Route::resource('meal-packages',MealPackageController::class);

    Route::resource('rate-code',RateCodeController::class);

    Route::apiResource('guestInhouse',GuestInhouseController::class);

    Route::apiResource('reservation',ReservationController::class);
    Route::put('checkIn/{id}',[ReservationController::class,'checkIn']);
    Route::post('cancel/{id}',[ReservationController::class,'cancel']);
    Route::post('reInstate/{id}',[ReservationController::class,'reInstate']);

    Route::apiResource('roomChange',RoomChangeController::class);


});

Route::post('user-login', [AuthController::class, 'login']);


Route::resource('room_types', RoomTypeController::class);


Route::get('users',[AuthController::class,'users']);

Route::resource('language', LocalizationController::class);

Route::get('getAllPermissios', [PermissionController::class,'index']);
Route::post('getPermissionById/{id}', [PermissionController::class,'getPermissionByID']);
Route::post('updatePermission/{id}', [PermissionController::class,'update']);
Route::post('storePermission', [PermissionController::class,'store']);
Route::post('permissionDelete/{id}', [PermissionController::class,'delete']);


Route::get('getAllRoles', [RoleController::class,'index']);
Route::post('getRoleById/{id}', [RoleController::class,'getRoleByID']);
Route::post('storeRole', [RoleController::class,'store']);
Route::post('updateRole/{id}', [RoleController::class,'updateRole']);
Route::post('assignPermissionRole/{id}', [RoleController::class,'assignPermissionForRole']);
Route::post('deleteRole/{id}', [RoleController::class,'destroy']);
Route::get('getAllPermissios', [PermissionController::class, 'index']);
Route::post('getPermissionById/{id}', [PermissionController::class, 'getPermissionForUser']);
Route::post('updatePermission', [PermissionController::class, 'update']);
Route::post('storePermission', [PermissionController::class, 'store']);
Route::post('permissionDelete/{id}', [PermissionController::class, 'delete']);

Route::get('getAllRoles', [RoleController::class, 'index']);
Route::post('ruleById', [RoleController::class, 'getRoleForUser']);
Route::post('getRoleById', [RoleController::class, 'getPermissionForUser']);
Route::post('storeRole', [RoleController::class, 'store']);
Route::post('updateRole', [RoleController::class, 'updateRole']);
Route::post('deleteRole/{id}', [RoleController::class, 'destroy']);

Route::apiResource('plan', PlanController::class);
Route::post('assosiative/{id}', [PlanController::class, 'createPlanFeature']);
Route::get('getSoftDeletedData', [PlanController::class, 'geSoftDeletedData']);
Route::post('restorDataTrashed/{id}', [PlanController::class, 'restorDataTrashed']);
Route::post('planForceDelete/{id}', [PlanController::class, 'DBDelete']);

Route::apiResource('feature', FeatureController::class);
Route::get('getSoftDeletedFeatureData', [FeatureController::class, 'geSoftDeletedData']);
Route::post('restorFeatureDataTrashed/{id}', [FeatureController::class, 'restorDataTrashed']);
Route::post('featureForceDelete/{id}', [FeatureController::class, 'DBDelete']);
Route::resource('floor',FloorController::class);
Route::post('restoreFloorDataTrashed/{id}',[FloorController::class,'restoreTrashed']);

Route::apiResource('rooms', RoomController::class);
Route::get('getRoomsDeleted', [RoomController::class, 'geSoftDeletedData']);
Route::post('restorRoomDataTrashed/{id}', [RoomController::class, 'restorDataTrashed']);
Route::resource('segment', MarketController::class);
Route::resource('sourcebusiness', SourceBusinessController::class);
Route::apiResource('companyProfile', companyProfileController::class);
Route::resource('payment',PaymentController::class);

Route::resource('tenant', TenantController::class);
Route::apiResource('guestProfile',GuestProfileController::class);
Route::apiResource('companystate',CompanyStatementController::class);
Route::apiResource('oordservicse',OordServiceController::class);
Route::post('change/{id}',[OordServiceController::class,'changeRoom']);
Route::post('return/{id}',[OordServiceController::class,'returnRoom']);






Route::middleware('tenant')->group(function () {
    // routes
});
