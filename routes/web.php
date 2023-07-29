<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\ViewerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserAuthController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('cms/')->middleware('guest:admin,author')->group(function(){
    Route::get('{guard}/login', [UserAuthController::class,'showLogin'])->name('view.login');
    Route::post('{guard}/login' , [UserAuthController::class , 'login']);
});

Route::prefix('cms/admin')->middleware('auth:admin,author')->group(function(){
    Route::get('logout' , [UserAuthController::class , 'logout'])->name('view.logout');
});

Route::prefix('cms/admin/')->middleware('auth:admin,author')->group(function(){
    Route::view('' , 'cms.home');

    Route::resource('countries' , CountryController::class);
    Route::post('countries_update/{id}' , [CountryController::class , 'update'])->name('countries_update');
    Route::get('countries_recycle', [CountryController::class,'recycle'])->name('countries_recycle');
    Route::get('countries_restore/{id}', [CountryController::class,'restore'])->name('countries_restore');
    Route::get('countries_delete/{id}', [CountryController::class,'force'])->name('countries_delete');

    Route::resource('cities' , CityController::class);
    Route::post('cities_update/{id}' , [CityController::class , 'update'])->name('cities_update');
    Route::get('cities_recycle', [CityController::class,'recycle'])->name('cities_recycle');
    Route::get('cities_restore/{id}', [CityController::class,'restore'])->name('cities_restore');
    Route::get('cities_delete/{id}', [CityController::class,'force'])->name('cities_delete');

    Route::resource('specialities' , SpecialityController::class);
    Route::post('specialities_update/{id}' , [SpecialityController::class , 'update'])->name('specialities_update');
    Route::get('specialities_recycle', [SpecialityController::class,'recycle'])->name('specialities_recycle');
    Route::get('specialities_restore/{id}', [SpecialityController::class,'restore'])->name('specialities_restore');
    Route::get('specialities_delete/{id}', [SpecialityController::class,'force'])->name('specialities_delete');

    Route::resource('admins' , AdminController::class);
    Route::post('admins_update/{id}' , [AdminController::class , 'update'])->name('admins_update');
    Route::get('admins_recycle', [AdminController::class,'recycle'])->name('admins_recycle');
    Route::get('admins_restore/{id}', [AdminController::class,'restore'])->name('admins_restore');
    Route::get('admins_delete/{id}', [AdminController::class,'force'])->name('admins_delete');

    Route::resource('authors' , AuthorController::class);
    Route::post('authors_update/{id}' , [AuthorController::class , 'update'])->name('authors_update');
    Route::get('authors_recycle', [AuthorController::class,'recycle'])->name('authors_recycle');
    Route::get('authors_restore/{id}', [AuthorController::class,'restore'])->name('authors_restore');
    Route::get('authors_delete/{id}', [AuthorController::class,'force'])->name('authors_delete');

    Route::resource('viewers' , ViewerController::class);
    Route::post('viewers_update/{id}' , [ViewerController::class , 'update'])->name('viewers_update');
    Route::get('viewers_recycle', [ViewerController::class,'recycle'])->name('viewers_recycle');
    Route::get('viewers_restore/{id}', [ViewerController::class,'restore'])->name('viewers_restore');
    Route::get('viewers_delete/{id}', [ViewerController::class,'force'])->name('viewers_delete');

    Route::resource('categories' , CategoryController::class);
    Route::post('categories_update/{id}' , [CategoryController::class , 'update'])->name('categories_update');
    Route::get('categories_recycle', [CategoryController::class,'recycle'])->name('categories_recycle');
    Route::get('categories_restore/{id}', [CategoryController::class,'restore'])->name('categories_restore');
    Route::get('categories_delete/{id}', [CategoryController::class,'force'])->name('categories_delete');

    Route::resource('articles' , ArticleController::class);
    Route::post('articles_update/{id}' , [ArticleController::class , 'update'])->name('articles_update');
    Route::get('articles_recycle', [ArticleController::class,'recycle'])->name('articles_recycle');
    Route::get('articles_restore/{id}', [ArticleController::class,'restore'])->name('articles_restore');
    Route::get('articles_delete/{id}', [ArticleController::class,'force'])->name('articles_delete');
    Route::get('articles_recycle/{authid}', [ArticleController::class,'recycleArticle'])->name('articles1recycle');
    Route::get('articles_restore/{id}/{authid}', [ArticleController::class,'restoreArticle'])->name('articles1restore');
    Route::get('articles_delete/{id}/{authid}', [ArticleController::class,'forceArticle'])->name('articles1delete');
    Route::get('/create/articles/{authid}', [ArticleController::class, 'createArticle'])->name('createArticle');
    Route::get('/index/articles/{authid}', [ArticleController::class, 'indexArticle'])->name('indexArticle');

    Route::resource('comments' , CommentController::class);

    Route::resource('contacts' , ContactController::class);

    Route::resource('sliders' , SliderController::class);
    Route::post('sliders_update/{id}' , [SliderController::class , 'update'])->name('sliders_update');

    Route::resource('roles' , RoleController::class);
    Route::post('roles_update/{id}',[RoleController::class , 'update'])->name('roles_update');

    Route::resource('permissions' , PermissionController::class);
    Route::post('permissions_update/{id}',[PermissionController::class , 'update'])->name('permissions_update');

    Route::resource('roles.permissions' , RolePermissionController::class);
});

Route::prefix('news/')->group(function(){
    Route::get('home' , [HomeController::class , 'home'])->name('news.home');
    Route::get('det/{id}' , [HomeController::class , 'det'])->name('detailes');
    Route::get('all/{id}' , [HomeController::class , 'all'])->name('allNews');
    Route::get('contact' , [HomeController::class , 'showContact'])->name('contact');
    Route::post('store' , [HomeController::class , 'storeContact']);
});
