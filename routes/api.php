<?php

use App\Http\Controllers\API\FeatureController;
use App\Http\Controllers\API\LangController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\PromoController;
use App\Http\Controllers\API\SitemapController;
use App\Http\Controllers\API\SocialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('features', FeatureController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('socials', SocialController::class);
Route::apiResource('sitemaps', SitemapController::class);
Route::apiResource('promos', PromoController::class);
Route::apiResource('langs', LangController::class);
