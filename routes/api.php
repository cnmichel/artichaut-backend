<?php

use App\Http\Controllers\API\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LangController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\HeroController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\FeatureController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\PromoController;
use App\Http\Controllers\API\SitemapController;
use App\Http\Controllers\API\SocialController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(RegisterController::class)->group(function(){
    Route::post('register','register');
    Route::post('login','login');
    Route::post('verifyToken', 'verifyToken');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('socials', SocialController::class);
    Route::apiResource('langs', LangController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('reviews', ReviewController::class);
    Route::apiResource('heroes', HeroController::class);
    Route::apiResource('articles', ArticleController::class);
    Route::apiResource('features', FeatureController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('promos', PromoController::class);
    Route::apiResource('sitemaps', SitemapController::class);
});
