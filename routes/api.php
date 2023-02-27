<?php

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ReservationController;
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
use App\Http\Controllers\API\VideoController;
use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PaymentController;

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

// Route d'API pour l'authentification utilisateur
Route::controller(RegisterController::class)->group(function(){
    Route::post('register','register');
    Route::post('login','login');
    Route::post('verifyToken', 'verifyToken');
    Route::post('getUserByToken', 'getUserByToken');
    Route::post('revokeToken', 'revokeToken');
});

Route::controller(ProductController::class)->group(function(){
    Route::get('getAvailable','getAvailable');
});

// Route d'API pour récupérer les données
Route::apiResource('langs', LangController::class)->only(['index', 'show']);
Route::apiResource('roles', RoleController::class)->only(['index', 'show']);
Route::apiResource('users', UserController::class)->only(['index', 'show']);
Route::apiResource('customers', CustomerController::class)->only(['index', 'show']);
Route::apiResource('reviews', ReviewController::class)->only(['index', 'show']);
Route::apiResource('heroes', HeroController::class)->only(['index', 'show']);
Route::apiResource('articles', ArticleController::class)->only(['index', 'show']);
Route::apiResource('features', FeatureController::class)->only(['index', 'show']);
Route::apiResource('products', ProductController::class)->only(['index', 'show']);
Route::apiResource('promos', PromoController::class)->only(['index', 'show']);
Route::apiResource('sitemaps', SitemapController::class)->only(['index', 'show']);
Route::apiResource('socials', SocialController::class)->only(['index', 'show']);
Route::apiResource('videos', VideoController::class)->only(['index', 'show']);
Route::apiResource('addresses', AddressController::class)->only(['index', 'show']);
Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
Route::apiResource('reservations', ReservationController::class)->only(['index','show']);
Route::apiResource('payments', PaymentController::class)->only(['index','show']);

// Route d'API protéger par Sanctum pour la modification de données
Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('langs', LangController::class)->except(['index', 'show']);
    Route::apiResource('roles', RoleController::class)->except(['index', 'show']);
    Route::apiResource('users', UserController::class)->except(['index', 'show']);
    Route::apiResource('customers', CustomerController::class)->except(['index', 'show']);
    Route::apiResource('reviews', ReviewController::class)->except(['index', 'show']);
    Route::apiResource('heroes', HeroController::class)->except(['index', 'show']);
    Route::apiResource('articles', ArticleController::class)->except(['index', 'show']);
    Route::apiResource('features', FeatureController::class)->except(['index', 'show']);
    Route::apiResource('products', ProductController::class)->except(['index', 'show']);
    Route::apiResource('promos', PromoController::class)->except(['index', 'show']);
    Route::apiResource('sitemaps', SitemapController::class)->except(['index', 'show']);
    Route::apiResource('socials', SocialController::class)->except(['index', 'show']);
    Route::apiResource('videos', VideoController::class)->except(['index', 'show']);
    Route::apiResource('addresses', AddressController::class)->except(['index', 'show']);
    Route::apiResource('categories', CategoryController::class)->except(['index', 'show']);
    Route::apiResource('reservations', ReservationController::class)->except(['index','show']);
    Route::apiResource('payments', PaymentController::class)->except(['index','show']);
});

