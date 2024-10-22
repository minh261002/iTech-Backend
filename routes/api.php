<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PostCatalogueController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'as' => 'admin.',
    'middleware' => []
], function () {
    Route::post('/generate/upload-url', [AdminController::class, 'generateUploadUrl']);

    Route::get('/provinces', [LocationController::class, 'getProvinces']);
    Route::get('/districts/{province_code}', [LocationController::class, 'getDistricts']);
    Route::get('/wards/{district_code}', [LocationController::class, 'getWards']);


    Route::group([
        'middleware' => ['jwt'],
        'prefix' => 'auth'
    ], function ($router) {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);

    });

    Route::post('auth/login', [AuthController::class, 'login']);
    Route::post('auth/refresh', [AuthController::class, 'refresh']);
    Route::post('auth/forgot-password', [AuthController::class, 'sendLinkResetPassword']);
    Route::post('auth/reset-password', [AuthController::class, 'resetPassword']);


    Route::middleware(['jwt', 'admin_auth:admin'])->group(function () {
        //Module
        Route::prefix('module')->group(function () {
            Route::get('/', [ModuleController::class, 'index']);
            Route::get('/{id}', [ModuleController::class, 'show']);
            Route::post('create', [ModuleController::class, 'create']);
            Route::put('/{id}', [ModuleController::class, 'update']);
            Route::delete('/{id}', [ModuleController::class, 'destroy']);
        });

        //Permission
        Route::prefix('permission')->group(function () {
            Route::get('/', [PermissionController::class, 'index']);
            Route::get('/{id}', [PermissionController::class, 'show']);
            Route::post('create', [PermissionController::class, 'create']);
            Route::put('/{id}', [PermissionController::class, 'update']);
            Route::delete('/{id}', [PermissionController::class, 'destroy']);
        });

        //Role
        Route::prefix('role')->group(function () {
            Route::get('/', [RoleController::class, 'index']);
            Route::get('/getModules', [RoleController::class, 'getModules']);
            Route::get('/{id}', [RoleController::class, 'show']);
            Route::post('create', [RoleController::class, 'create']);
            Route::put('/{id}', [RoleController::class, 'update']);
            Route::delete('/{id}', [RoleController::class, 'destroy']);
        });

        //Admin
        Route::prefix('admin')->group(function () {
            Route::get('/', [AdminController::class, 'index']);
            Route::get('/{id}', [AdminController::class, 'show']);
            Route::post('create', [AdminController::class, 'create']);
            Route::put('/{id}', [AdminController::class, 'update']);
            Route::delete('/{id}', [AdminController::class, 'destroy']);
        });

        //Member
        Route::prefix('member')->group(function () {
            Route::get('/', [MemberController::class, 'index']);
            Route::get('/{id}', [MemberController::class, 'show']);
            Route::post('create', [MemberController::class, 'create']);
            Route::put('/{id}', [MemberController::class, 'update']);
            Route::patch('/{id}/status', [MemberController::class, 'updateStatus']);
            Route::delete('/{id}', [MemberController::class, 'destroy']);
        });

        //Post Catalogue
        Route::prefix('post/catalogue')->group(function () {
            Route::get('/', [PostCatalogueController::class, 'index']);
            Route::get('/{id}', [PostCatalogueController::class, 'show']);
            Route::post('create', [PostCatalogueController::class, 'create']);
            Route::put('/{id}', [PostCatalogueController::class, 'update']);
            Route::patch('/{id}/status', [PostCatalogueController::class, 'updateStatus']);
            Route::delete('/{id}', [PostCatalogueController::class, 'destroy']);
        });

        //Post
        Route::prefix('post')->group(function () {
            Route::get('/', [PostController::class, 'index']);
            Route::get('/{id}', [PostController::class, 'show']);
            Route::post('create', [PostController::class, 'create']);
            Route::put('/{id}', [PostController::class, 'update']);
            Route::patch('/{id}/status', [PostController::class, 'updateStatus']);
            Route::delete('/{id}', [PostController::class, 'destroy']);
        });
    });


});
