<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Fw4aController;
use App\Http\Controllers\Users_listController; // Import your Users_listController
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\IlcdbController;
use App\Http\Controllers\SparkController;
Route::get('/', function () {
    return view('auth.admin-login');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

Route::get('/nbp', [App\Http\Controllers\NbpController::class, 'index'])->name('nbp');
Route::get('/egov', [App\Http\Controllers\EgovController::class, 'index'])->name('egov');
Route::get('/gecs', [App\Http\Controllers\GecsController::class, 'index'])->name('gecs');
    
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('profile.change-password-form');
Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');

// Tech4ED Routes
Route::get('/tech4ed', [App\Http\Controllers\Tech4edController::class, 'index'])->name('tech4ed');
Route::get('/tech4ed/create', [App\Http\Controllers\Tech4edController::class, 'create'])->name('tech4ed.create');
Route::post('/tech4ed', [App\Http\Controllers\Tech4edController::class, 'store'])->name('tech4ed.store');
Route::get('/tech4ed/visualization', [App\Http\Controllers\Tech4edController::class, 'visualization'])->name('tech4ed.visualization');
Route::get('/tech4ed/{tech4ed}', [App\Http\Controllers\Tech4edController::class, 'show'])->name('tech4ed.show');
Route::get('/tech4ed/{tech4ed}/edit', [App\Http\Controllers\Tech4edController::class, 'edit'])->name('tech4ed.edit');
Route::put('/tech4ed/{tech4ed}', [App\Http\Controllers\Tech4edController::class, 'update'])->name('tech4ed.update');
Route::delete('/tech4ed/{tech4ed}', [App\Http\Controllers\Tech4edController::class, 'destroy'])->name('tech4ed.destroy');

// routes/web.php
Route::get('/bplo', [App\Http\Controllers\BploController::class, 'index'])->name('bplo');
Route::get('/bplo/create', [App\Http\Controllers\BploController::class, 'create'])->name('bplo.create');
Route::post('/bplo', [App\Http\Controllers\BploController::class, 'store'])->name('bplo.store');
Route::get('/bplo/visualization', [App\Http\Controllers\BploController::class, 'visualization'])->name('bplo.visualization');
Route::get('/bplo/{bplo}', [App\Http\Controllers\BploController::class, 'show'])->name('bplo.show');
Route::get('/bplo/{bplo}/edit', [App\Http\Controllers\BploController::class, 'edit'])->name('bplo.edit');
Route::put('/bplo/{bplo}', [App\Http\Controllers\BploController::class, 'update'])->name('bplo.update');
Route::delete('/bplo/{bplo}', [App\Http\Controllers\BploController::class, 'destroy'])->name('bplo.destroy');

// IBPLS Routes
// Main IBPLS routes
Route::get('/ibpls', [App\Http\Controllers\IbplsController::class, 'index'])->name('ibpls');
Route::get('/ibpls/create', [App\Http\Controllers\IbplsController::class, 'create'])->name('ibpls.create');
Route::post('/ibpls', [App\Http\Controllers\IbplsController::class, 'store'])->name('ibpls.store');
Route::get('/ibpls/visualization', [App\Http\Controllers\IbplsController::class, 'visualization'])->name('ibpls.visualization');
Route::get('/ibpls/{ibpls}', [App\Http\Controllers\IbplsController::class, 'show'])->name('ibpls.show');
Route::get('/ibpls/{ibpls}/edit', [App\Http\Controllers\IbplsController::class, 'edit'])->name('ibpls.edit');
Route::put('/ibpls/{ibpls}', [App\Http\Controllers\IbplsController::class, 'update'])->name('ibpls.update');
Route::delete('/ibpls/{ibpls}', [App\Http\Controllers\IbplsController::class, 'destroy'])->name('ibpls.destroy');
Route::get('/ibpls/reset-ids', [App\Http\Controllers\IbplsController::class, 'resetIds'])->name('ibpls.resetIds');


// PNP-KI Routes
Route::get('/pnpki', [App\Http\Controllers\PnpkiController::class, 'index'])->name('pnpki');
Route::get('/pnpki/create', [App\Http\Controllers\PnpkiController::class, 'create'])->name('pnpki.create');
Route::post('/pnpki', [App\Http\Controllers\PnpkiController::class, 'store'])->name('pnpki.store');
Route::get('/pnpki/visualization', [App\Http\Controllers\PnpkiController::class, 'visualization'])->name('pnpki.visualization');
Route::get('/pnpki/{pnpki}', [App\Http\Controllers\PnpkiController::class, 'show'])->name('pnpki.show');
Route::get('/pnpki/{pnpki}/edit', [App\Http\Controllers\PnpkiController::class, 'edit'])->name('pnpki.edit');
Route::put('/pnpki/{pnpki}', [App\Http\Controllers\PnpkiController::class, 'update'])->name('pnpki.update');
Route::delete('/pnpki/{pnpki}', [App\Http\Controllers\PnpkiController::class, 'destroy'])->name('pnpki.destroy');


//Cybersecurity Routes
// routes/web.php (add these routes)
Route::get('/cybersecurity', [App\Http\Controllers\CybersecurityController::class, 'index'])->name('cybersecurity');
Route::get('/cybersecurity/create', [App\Http\Controllers\CybersecurityController::class, 'create'])->name('cybersecurity.create');
Route::post('/cybersecurity', [App\Http\Controllers\CybersecurityController::class, 'store'])->name('cybersecurity.store');
Route::get('/cybersecurity/visualization', [App\Http\Controllers\CybersecurityController::class, 'visualization'])->name('cybersecurity.visualization');
Route::get('/cybersecurity/{cybersecurity}', [App\Http\Controllers\CybersecurityController::class, 'show'])->name('cybersecurity.show');
Route::get('/cybersecurity/{cybersecurity}/edit', [App\Http\Controllers\CybersecurityController::class, 'edit'])->name('cybersecurity.edit');
Route::put('/cybersecurity/{cybersecurity}', [App\Http\Controllers\CybersecurityController::class, 'update'])->name('cybersecurity.update');
Route::delete('/cybersecurity/{cybersecurity}', [App\Http\Controllers\CybersecurityController::class, 'destroy'])->name('cybersecurity.destroy');


Route::controller(Users_listController::class)->prefix('users_lists')->group(function () {
       
Route::get('/users_list', [Users_listController::class, 'index'])->name('indexusers');
Route::get('/users_list/create', [Users_listController::class, 'create'])->name('users_lists.create');
Route::post('/users_list/store', [Users_listController::class, 'store'])->name('users_lists.store');

Route::get('/users_list/{users_list}', [Users_listController::class, 'show'])->name('users_lists.show');
Route::get('/users_list/{users_list}/edit', [Users_listController::class, 'edit'])->name('users_lists.edit');
Route::put('/users_list/{users_list}', [Users_listController::class, 'update'])->name('users_lists.update');

Route::delete('/users_list/{users_list}', [Users_listController::class, 'destroy'])->name('users_lists.destroy');
    });

    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
});

//Employee Management Route
//Get Methods
Route::middleware(['auth'])->group(function () {
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
});

//Auth Routes
Route::get('/employee/login', [AuthController::class, 'employeeLogin'])->name('employee.login');
Route::post('/employee/login', [AuthController::class, 'employeeLoginAction'])->name('employee.login.action');
Route::get('/employee/register', [AuthController::class, 'employeeRegister'])->name('employee.register');
Route::post('/employee/register', [AuthController::class, 'emp_registerSave'])->name('employee.register.save');
Route::get('/employee/logout', [AuthController::class, 'employeeLogout'])->middleware('auth:employee')->name('employee.logout');

//Middleware
Route::middleware('auth:employee')->group(function () {
    Route::get('employee/dashboard', function () {
        return view('employee.dashboard');
    })->name('dashboard.employee');
});

//FW4A Routes

Route::middleware('auth')->group(function () {
    Route::get('/fw4a',[Fw4aController::class, 'index'])->name('fw4a');
    Route::post('/fw4a', [Fw4aController::class, 'store'])->name('fw4a.store');
});

/*forms*/
Route::get('/get-provinces/{region_id}', [LocationController::class, 'getProvinces']);
Route::get('/get-districts/{province_id}', [LocationController::class, 'getDistricts']);
Route::get('/get-localities/{district_id}', [LocationController::class, 'getLocalities']);
Route::post('/districts', [FormController::class, 'storeDistrict'])->name('districts.store');
Route::post('/localities', [FormController::class, 'storeLocality'])->name('localities.store');
Route::get('/test', [FormController::class, 'getRegion']);

//ILCDB Routes
Route::get('/ilcdb', [IlcdbController::class, 'index'])->name('ilcdb');

// Spark Routes
Route::get('/spark', [SparkController::class, 'index'])->name('spark');