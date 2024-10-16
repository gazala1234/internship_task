<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::get('/', function () {
    return view('welcome');
});

Route::resource('companies', CompanyController::class);
Route::resource('employees', EmployeeController::class);

Route::get('employee/profile-picture/{employee}', function (Employee $employee) {
    if (auth()->check() && $employee->profile_picture) {
        $path = storage_path('app/private/' . $employee->profile_picture);
        return response()->file($path);
    }

    abort(403); 
})->name('employee.profile_picture');

?>