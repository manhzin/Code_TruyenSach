<?php

use App\Http\Controllers\Frontend\BasePageController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\ChapterController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SocialAuthController;
use App\Http\Controllers\Frontend\StoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::any('{path}', [BasePageController::class, 'action'])->where('path', '^(?!admin.*$).*');
Route::any('/', [HomeController::class, 'index'])->name('home');
Route::get('/the-loai/{slug}', [CategoryController::class, 'index'])->name('category');
Route::get('/truyen/{slug}', [StoryController::class, 'index'])->name('story');
Route::get('/{slugStory}/{slugChapter}', [ChapterController::class, 'index'])->name('chapter');
Route::post('/ajax/get-chapters', [ChapterController::class, 'getChapters'])->name('get.chapters');
Route::post('/get-list-story-hot', [HomeController::class, 'getListStoryHot'])->name('get.list.story.hot');
Route::post('/get-list-story-hot-random', [HomeController::class, 'getListStoryHotRandom'])->name('get.list.story.hot.random');
Route::post('/ajax/search-story', [HomeController::class, 'searchStory'])->name('search.story');
Route::get('/tim-kiem', [HomeController::class, 'mainSearchStory'])->name('main.search.story');
Route::get('/phan-loai-theo-chuong', [StoryController::class, 'followChaptersCount'])->name('get.list.story.with.chapters.count');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::get('/dang-ki', [HomeController::class, 'dangki'])->name('dang-ki');
Route::get('/dang-nhap', [HomeController::class, 'dangnhap'])->name('dang-nhap');
Route::post('/register-publisher', [HomeController::class, 'register_publisher'])->name('register-publisher');
Route::post('/login-publisher', [HomeController::class, 'login_publisher'])->name('login-publisher');
Route::get('/dang-xuat', [HomeController::class, 'sign_out'])->name('dang-xuat');
Route::get('/yeu-thich', [HomeController::class, 'yeu_thich'])->name('yeu-thich');
Route::post('/themyeuthich', [HomeController::class, 'themyeuthich'])->name('themyeuthich');
Route::delete('/xoayeuthich/{id}', [HomeController::class, 'xoayeuthich'])->name('xoayeuthich.delete');
