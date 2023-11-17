<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvController;
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

Route::get('employee/asset_info', function () {
    return view('/employee/asset_info');
});


Route::post('/upload', [InvController::class, 'uploadCsvFile']);

Route::get('admin/receiving_repo', function () {
    $results = DB::select('select * from receiving_report where req_status = "accepted"');
    Log::info(count((array)$results));
    $results = (array)$results;
    Log::info($results);
    return view('admin/receiving_repo', compact('results')); 
})->name('admin/receiving_repo');

Route::view('admin/ack_repo', 'admin/ack_repo')->name('admin/ack_repo');
Route::view('admin/prop_borr', 'admin/prop_borr')->name('admin/prop_borr');
Route::view('admin/main_req', 'admin/main_req')->name('admin/main_req');
Route::view('admin/calib_req', 'admin/calib_req')->name('admin/calib_req');
Route::view('admin/condemn_req', 'admin/condemn_req')->name('admin/condemn_req');
Route::view('admin/asset_info', 'admin/asset_info')->name('admin/asset_info');

Route::get('admin/pending', function () {
    $results = DB::select('select * from receiving_report where req_status = "pending" or req_status = "declined"');
    Log::info(count((array)$results));
    $results = (array)$results;
    Log::info($results);
    return view('admin/pending', compact('results')); 
})->name('admin/pending');



Route::get('employee/receiving_repo', function () {
    $results = DB::select('select * from receiving_report where req_status = "pending" or req_status = "declined"');
    Log::info(count((array)$results));
    $results = (array)$results;
    Log::info($results);
    return view('employee/receiving_repo', compact('results')); 
})->name('employee/receiving_repo');

Route::get('employee/ack_repo', function () {
    $results = DB::select('select * from acknowledgement_report where status = "pending" or status = "declined"');
    Log::info(count((array)$results));
    $results = (array)$results;
    Log::info($results);
    return view('employee/ack_repo', compact('results')); 
})->name('employee/ack_repo');

Route::get('employee/prop_borr', function () {
    $results = DB::select('select * from property_borrowing where status = "pending" or status = "declined"');
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
    $results = DB::select('select * from maintenance_report where status = "pending" or status = "declined"');
    Log::info(count((array)$results));
    $results = (array)$results;
    Log::info($results);
    return view('employee/main_req', compact('results')); 
})->name('employee/main_req');

Route::get('employee/condemn_req', function () {
    $results = DB::select('select * from condemnation where status = "pending" or status = "declined"');
    Log::info(count((array)$results));
    $results = (array)$results;
    Log::info($results);
    return view('employee/condemn_req', compact('results')); 
})->name('employee/condemn_req');

Route::get('employee/calib_req', function () {
    $results = DB::select('select * from calibration where status = "pending" or status = "declined"');
    Log::info(count((array)$results));
    $results = (array)$results;
    Log::info($results);
    return view('employee/calib_req', compact('results')); 
})->name('employee/calib_req');

Route::view('employee/asset_info', 'employee/asset_info')->name('employee/asset_info');



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

Route::get('pdf',[PdfExtractorController::class,'extractPdf']);

require __DIR__ . '/auth.php';
