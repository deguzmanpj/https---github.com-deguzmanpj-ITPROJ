<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashControlEmp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


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

Route::get('/', function () {
    return view('login');
});

Route::post('/loginpage', [InvController::class, 'showDashboard']);

Route::post('/rr_report', [InvController::class, 'addEntry']);

Route::post('/update_rr', [InvController::class, 'updateRR']);

Route::post('/ack_report', [InvController::class, 'addAckR']);

Route::post('/update_ack', [InvController::class, 'updateAck']);

Route::post('/prop_report', [InvController::class, 'addProp']);

Route::post('/update_prop', [InvController::class, 'updateProp']);

Route::post('/main_report', [InvController::class, 'addMain']);

Route::post('/update_main', [InvController::class, 'updateMain']);

Route::post('/condemn_report', [InvController::class, 'addCond']);

Route::post('/update_condemn', [InvController::class, 'updateCond']);

Route::post('/calib_report', [InvController::class, 'addCalib']);

Route::post('/update_calib', [InvController::class, 'updateCalib']);

Route::post('/add_to_asset_info', [InvController::class, 'addToAssetInfo']);

Route::post('/add_to_ack', [InvController::class, 'addToAck']);

Route::post('/add_to_condemn', [InvController::class, 'addToCondemn']);

Route::post('/add_to_prop', [InvController::class, 'addToProp']);

Route::post('/add_to_calib', [InvController::class, 'addToCalib']);

Route::post('/add_to_main', [InvController::class, 'addToMain']);

Route::post('/see_form', [InvController::class, 'seeForm']);

Route::post('/see_ack_form', [InvController::class, 'seeAckForm']);

Route::post('/see_prop_borr', [InvController::class, 'seePropBorr']);

Route::post('/see_main', [InvController::class, 'seeMain']);

Route::post('/see_condemn', [InvController::class, 'seeCondemn']);

Route::post('/see_calib', [InvController::class, 'seeCalib']);

Route::post('/decline_request', [InvController::class, 'declineRequest']);

Route::post('/edit_asset', [InvController::class, 'editAsset']);

Route::get('/admin/asset_info', function () {
    return view('/admin/asset_info');
});

// Route::get('employee/asset_info', function () {
//     $results = DB::select('select * from asset where status = "accepted"');
//     Log::info(count((array)$results));
//     $results = (array)$results;
//     Log::info($results);
//     return view('/employee/asset_info', compact('results')); 
// });


Route::post('/upload', [InvController::class, 'uploadCsvFile']);

Route::get('admin/receiving_repo', function () {
    $results = DB::select('select * from receiving_report');
    Log::info(count((array)$results));
    $results = (array)$results;
    Log::info($results);
    return view('admin/receiving_repo', compact('results')); 
})->name('admin/receiving_repo');

Route::get('admin/ack_repo', function () {
    $results = DB::select('select * from acknowledgement_report');
    Log::info(count((array)$results));
    $results = (array)$results;
    Log::info($results);
    return view('admin/ack_repo', compact('results')); 
})->name('admin/ack_repo');

Route::get('admin/prop_borr', function () {
    $results = DB::select('select * from property_borrowing');
    Log::info(count((array)$results));
    $results = (array)$results;
    Log::info($results);
    return view('admin/prop_borr', compact('results')); 
})->name('admin/prop_borr');

Route::get('admin/main_req', function () {
    $results = DB::select('select * from maintenance_report');
    Log::info(count((array)$results));
    $results = (array)$results;
    Log::info($results);
    return view('admin/main_req', compact('results')); 
})->name('admin/main_req');

Route::get('admin/calib_req', function () {
    $results = DB::select('select * from calibration');
    Log::info(count((array)$results));
    $results = (array)$results;
    Log::info($results);
    return view('admin/calib_req', compact('results')); 
})->name('admin/calib_req');

Route::get('admin/condemn_req', function () {
    $results = DB::select('select * from condemnation');
    Log::info(count((array)$results));
    $results = (array)$results;
    Log::info($results);
    return view('admin/condemn_req', compact('results')); 
})->name('admin/condemn_req');


Route::get('admin/asset_info', function(){
    $results = DB::select('select * from asset');
        Log::info(count((array)$results));
        $results = (array)$results;
        Log::info($results);
        return view('admin/asset_info', compact('results')); 
})->name('admin/asset_info');


Route::get('employee/receiving_repo', function () {
    $results = DB::select('select * from receiving_report');
    Log::info(count((array)$results));
    $results = (array)$results;
    Log::info($results);
    return view('employee/receiving_repo', compact('results')); 
})->name('employee/receiving_repo');

Route::get('employee/ack_repo', function () {
    $results = DB::select('select * from acknowledgement_report');
    Log::info(count((array)$results));
    $results = (array)$results;
    Log::info($results);
    return view('employee/ack_repo', compact('results')); 
})->name('employee/ack_repo');

Route::get('employee/prop_borr', function () {
    $results = DB::select('select * from property_borrowing');
    Log::info(count((array)$results));
    $results = (array)$results;
    Log::info($results);
    return view('employee/prop_borr', compact('results')); 
})->name('employee/prop_borr');

// Route::get('employee/receiving_repo', function () {
//     $results = DB::select('select * from receiving_report where req_status = "accepted" ');
//     Log::info(count((array)$results));
//     $results = (array)$results;
//     Log::info($results);
//     return view('employee/receiving_repo', compact('results')); 
// })->name('employee/receiving_repo');

Route::get('employee/main_req', function () {
    $results = DB::select('select * from maintenance_report');
    Log::info(count((array)$results));
    $results = (array)$results;
    Log::info($results);
    return view('employee/main_req', compact('results')); 
})->name('employee/main_req');

Route::get('employee/condemn_req', function () {
    $results = DB::select('select * from condemnation');
    Log::info(count((array)$results));
    $results = (array)$results;
    Log::info($results);
    return view('employee/condemn_req', compact('results')); 
})->name('employee/condemn_req');

Route::get('employee/calib_req', function () {
    $results = DB::select('select * from calibration');
    Log::info(count((array)$results));
    $results = (array)$results;
    Log::info($results);
    return view('employee/calib_req', compact('results')); 
})->name('employee/calib_req');

Route::get('employee/asset_info', function(){
    $results = DB::select('select * from asset');
        Log::info(count((array)$results));
        $results = (array)$results;
        Log::info($results);
        return view('employee/asset_info', compact('results')); 
})->name('employee/asset_info');



Route::get('employee/rr_form', function () {
    $results = DB::select('select * from units');
    $results = (array)$results;
    return view('employee/rr_form', compact('results')); 
})->name('employee/rr_form');

Route::get('employee/ack_form', function () {
    $results = DB::select('select * from units');
    $results = (array)$results;
    return view('employee/ack_form', compact('results')); 
})->name('employee/ack_form');

Route::get('employee/prop_form', function () {
    $results = DB::select('select * from units');
    $results = (array)$results;
    return view('employee/prop_form', compact('results')); 
})->name('employee/prop_form');

Route::get('employee/main_form', function () {
    $results = DB::select('select * from units');
    $results = (array)$results;
    return view('employee/main_form', compact('results')); 
})->name('employee/main_form');


Route::get('employee/condemn_form', function () {
    $results = DB::select('select * from units');
    $results = (array)$results;
    return view('employee/condemn_form', compact('results')); 
})->name('employee/condemn_form');

Route::get('employee/calib_form', function () {
    $results = DB::select('select * from units');
    $results = (array)$results;
    return view('employee/calib_form', compact('results')); 
})->name('employee/calib_form');

//User Management
Route::get('admin/users', function () {
    // Add logic to fetch user data here
    $userData = DB::select('select * from users'); // Fetch all user data 
  
    return view('admin/users', ['userData' => $userData]); // Pass user data to the 'user' view
})->name('admin/users');

Route::post('/add-user', [UserController::class, 'addUser'])->name('addUser');

// Add a route for editing a user
Route::get('admin/users/edit/{userId}', function ($userId) {
    $user = DB::table('users')->find($userId);
    return view('admin.editUser', ['user' => $user]);
})->name('admin/users.edit');

// Process user update form
Route::post('admin/users/update/{userId}', [UserController::class, 'editUser'])
    ->where(['userId' => '[0-9]+'])
    ->name('admin/users.update');

// Add a route for deleting a user
Route::post('admin/users/delete/{userId}', [UserController::class, 'deleteUser'])
    ->where(['userId' => '[0-9]+'])
    ->name('admin/users.delete');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Dashboard route
Route::get('admin/dash', [DashboardController::class, 'index'])->name('admin/dash');

Route::get('employee/dashB', [DashControlEmp::class, 'index'])->name('employee/dashB');

Route::get('pdf',[PdfExtractorController::class,'extractPdf']);

require __DIR__ . '/auth.php';
