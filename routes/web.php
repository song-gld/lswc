<?php

use App\Http\Controllers\lswcController;
use App\Http\Controllers\TeacherController;
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
})->name('index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
// 临时外出数据相关
Route::get('/insert', [lswcController::class, 'insert'])->name('lswc.insert');          //展示插入数据页面
Route::get('/store', [lswcController::class, 'store'])->name('store');                  //查找教师库姓名
Route::post('/insert', [lswcController::class, 'insertData'])->name('lswc.insertdata'); //向数据库插入数据
Route::delete('/delete/{lswc}', [lswcController::class, 'destroy'])->name('lswc.delete');//删除数据
//教师名单列表相关
Route::any('/teachers', [TeacherController::class, 'show'])->name('teachers');
Route::post('/teachers/add', [TeacherController::class, 'add'])->name('teachers.add');