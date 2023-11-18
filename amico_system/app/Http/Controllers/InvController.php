<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use res\js\asset_information;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class InvController extends Controller
{
    public function showDashboard()
{
    $number = request('number');
    $password = request('password'); // Retrieve the password from the form

    $user = DB::table('users')
        ->where('contact_no', $number)
        ->where('pass', $password) // Add this line to check the password
        ->select('role')
        ->first();

    if ($user) {
        $role = $user->role;

        if ($role == "admin") {
            return redirect("admin/dash");
        } else if ($role == "employee") {
            return redirect("employee/dashB");
        }
    }

    // Handle incorrect login cred
    return redirect()->back()->with('error', 'Invalid login credentials, please try again or contact your admin.');
}
    //Logout
    public function logout()
    {

        Auth::logout(); // Log the user out

        request()->session()->regenerateToken();

        // You can add any other additional logic here

        return view('login');
    }


    public function uploadCsvFile(Request $request)
    {
        // dd('Reached uploadCsvFile method'); // Add this line

        // Validate the uploaded file
        $request->validate([
            'csvFile' => 'required|mimes:csv', // Validation rule
        ]);

        // Store the file in the designated folder
        $request->file('csvFile')->storeAs('public/files', 'new.csv');


        $csvData = [];

        try {
            $filePath = 'public/files/new.csv';

            // Open the file for reading
            $handle = fopen(storage_path('app/' . $filePath), 'r');

            if ($handle !== false) {
                $index = 0;
                $csvData = [];

                while (($data = fgetcsv($handle)) !== false) {
                    if ($index >= 7) {
                        // Process each row of data
                        $csvData[] = $data;
                    }
                    $index = $index + 1;
                }

                fclose($handle);
            } else {
                // Error opening the file
                Log::error('Error opening CSV file');
            }
        } catch (\Exception $e) {
            // Handle any other exceptions that may occur
            Log::error('An exception occurred: ' . $e->getMessage());
        }



        $csvData = (array)$csvData;
        Log::info($csvData);

        for ($num = 0; $num < sizeof($csvData); $num++) {
            DB::insert(
                'insert into receiving_report 
                ( po_no, serial_no, funded_by, rs_no) 
                values (?,?,?,?)',
                [$csvData[$num][15], $csvData[$num][8], $csvData[$num][19], $csvData[$num][22]]
            );
        }
        return redirect("employee/receiving_repo");


        // Log::info('File path: ' . $path); // Log the file path

        // // Check if the file exists in the storage
        // if (Storage::disk('public')->exists($path)) {
        //     // File has been successfully captured
        //     Log::info('File captured successfully.');
        //     return back()->with('success', 'File uploaded successfully.');
        // } else {
        //     // File not found, handle the error
        //     Log::error('Failed to capture the file.');
        //     return back()->with('error', 'Failed to capture the file.');
        // }

        // $this->addToTable();
    }

    // public function addToTable()
    // {
    //     $dataFromController = 'Your data here';
    //     return view('asset_info', compact('dataFromController'));
    // }


    // public function showReceiving(){
    //     $results = DB::select('select * from receiving_report');
    //     Log::info(count((array)$results));
    //     $results = (array)$results;
    //     Log::info($results);
    //     if(){
    //         return view('emp/receiving_repo', compact('results')); 
    //     }else if (){
    //         return view('emp/receiving_repo', compact('results')); 
    //     }
    // }

    public function addEntry(Request $request)
    {

        $assetTags = $request->input('asset_tag');
        $assetDesc = $request->input('asset_desc');
        $serialNum = $request->input('serial_no');
        $assetClass = $request->input('asset_class');
        $brand = $request->input('brand');
        $model = $request->input('model');
        $qty = $request->input('qty');
        $uom = $request->input('uom');

        $remarks = $request->input('au_remarks');
        $allRemarks = "";
        foreach ($remarks as $remark) {
            if ($remark != null) {
                $allRemarks = $allRemarks . $remark . ",";
            }
        }

        $notes = $request->input('notes');
        $allNotes = " ";
        foreach ($notes as $note) {
            if ($note != null) {
                $allNotes = $allNotes . $note . ",";
            }
        }


        for ($int = 0; $assetTags[$int] != null; $int++) {
            DB::insert(
                'INSERT INTO receiving_report 
                (unit, unit_code, office, rr_no, 
                cb_a, reference, reference_date, received_from, ref_received_from, date_acq, asset_tag, asset_desc, 
                brand, model, serial_no, asset_class, qty, uom, funded_by, received_by,
                checked_by, amico_prepared_by, amico_prepared_by_date, amico_noted_by, amico_noted_by_date,
                req_status, cb_d, au_received_by, au_received_date,
                au_condition, au_remarks, au_checked_by, au_checked_by_date, au_noted_by, au_noted_by_date, ua_ack_by,
                ua_ack_by_position, ua_ack_by_date, fo_rec_copy_by, fo_rec_date, notes)   
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
                ?,?,?,?,?,?,?,?,?,?,?)',
                [
                    $request->input('unit'),
                    $request->input('unit_code'),
                    $request->input('office'),
                    $request->input('rr_no'),
                    $request->input('cb_a'),
                    $request->input('reference'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('reference_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('received_from'),
                    $request->input('ref_received_from'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('date_acq')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $assetTags[$int],
                    $assetDesc[$int],
                    $brand[$int],
                    $model[$int],
                    $serialNum[$int],
                    $assetClass[$int],
                    $qty[$int],
                    $uom[$int],
                    $request->input('funded_by'),
                    $request->input('received_by'),
                    $request->input('checked_by'),
                    $request->input('amico_prepared_by'),
                    $request->input('amico_prepared_by_date'),
                    $request->input('amico_noted_by'),
                    $request->input('amico_noted_by_date'),
                    "pending",
                    $request->input('cb_d'),
                    $request->input('au_received_by'),
                    $request->input('au_received_date'),
                    $request->input('au_condition'),
                    $allRemarks,
                    $request->input('au_checked_by'),
                    $request->input('au_checked_by_date'),
                    $request->input('au_noted_by'),
                    $request->input('au_noted_by_date'),
                    $request->input('ua_ack_by'),
                    $request->input('ua_ack_by_position'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('ua_ack_by_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('fo_rec_copy_by'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('fo_rec_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $allNotes,
                ]

            );
        }


        if ($request->input('user') === 'admin') {
            return redirect("admin/receiving_repo");
        } else {
            return redirect("employee/receiving_repo");
        }
    }

    public function updateRR(Request $request)
    {
        $assetTags = $request->input('asset_tag');
        $assetDesc = $request->input('asset_desc');
        $serialNum = $request->input('serial_no');
        $assetClass = $request->input('asset_class');
        $brand = $request->input('brand');
        $model = $request->input('model');
        $qty = $request->input('qty');
        $uom = $request->input('uom');

        $remarks = $request->input('au_remarks');
        $allRemarks = "";
        foreach ($remarks as $remark) {
            if ($remark != null) {
                $allRemarks = $allRemarks . $remark . ",";
            }
        }

        $notes = $request->input('notes');
        $allNotes = " ";
        foreach ($notes as $note) {
            if ($note != null) {
                $allNotes = $allNotes . $note . ",";
            }
        }


        // Retrieve all rows matching the condition
        $matchingRows = DB::table('receiving_report')->where('rr_no', $request->input('rr_no'))->get();
        for ($int = 0; $int < count($matchingRows); $int++) {
            DB::table('receiving_report')
                ->where('rr_id', $matchingRows[$int]->rr_id)
                ->update([
                    'unit' => $request->input('unit'),
                    'unit_code' => $request->input('unit_code'),
                    'office' => $request->input('office'),
                    'rr_no' => $request->input('rr_no'),
                    'cb_a' => $request->input('cb_a'),
                    'reference' => $request->input('reference'),
                    'reference_date' => \DateTime::createFromFormat('Y-m-d', $request->input('reference_date'))->format('Y-m-d'),
                    'received_from' => $request->input('received_from'),
                    'ref_received_from' => $request->input('ref_received_from'),
                    'date_acq' => \DateTime::createFromFormat('Y-m-d', $request->input('date_acq'))->format('Y-m-d'),
                    'asset_tag' => $assetTags[$int],
                    'asset_desc' => $assetDesc[$int],
                    'brand' => $brand[$int],
                    'model' => $model[$int],
                    'serial_no' => $serialNum[$int],
                    'asset_class' => $assetClass[$int],
                    'qty' => $qty[$int],
                    'uom' => $uom[$int],
                    'funded_by' => $request->input('funded_by'),
                    'received_by' => $request->input('received_by'),
                    'checked_by' => $request->input('checked_by'),
                    'amico_prepared_by' => $request->input('amico_prepared_by'),
                    'amico_prepared_by_date' => $request->input('amico_prepared_by_date'),
                    'amico_noted_by' => $request->input('amico_noted_by'),
                    'amico_noted_by_date' => $request->input('amico_noted_by_date'),
                    'req_status' => 'pending', // Assuming this is a constant value
                    'cb_d' => $request->input('cb_d'),
                    'au_received_by' => $request->input('au_received_by'),
                    'au_received_date' => $request->input('au_received_date'),
                    'au_condition' => $request->input('au_condition'),
                    'au_remarks' => $allRemarks,
                    'au_checked_by' => $request->input('au_checked_by'),
                    'au_checked_by_date' => $request->input('au_checked_by_date'),
                    'au_noted_by' => $request->input('au_noted_by'),
                    'au_noted_by_date' => $request->input('au_noted_by_date'),
                    'ua_ack_by' => $request->input('ua_ack_by'),
                    'ua_ack_by_position' => $request->input('ua_ack_by_position'),
                    'ua_ack_by_date' => \DateTime::createFromFormat('Y-m-d', $request->input('ua_ack_by_date'))->format('Y-m-d'),
                    'fo_rec_copy_by' => $request->input('fo_rec_copy_by'),
                    'fo_rec_date' => \DateTime::createFromFormat('Y-m-d', $request->input('fo_rec_date'))->format('Y-m-d'),
                    'notes' => $allNotes,
                ]);
        }

        if ($request->input('user') === 'admin') {
            return redirect("admin/receiving_repo");
        } else {
            return redirect("employee/receiving_repo");
        }
    }



    public function seeForm(Request $request)
    {
        $results = DB::select('select * from receiving_report where rr_no = "' . $request->input("rr_no") . '"');
        $results = (array)$results;

        $units = DB::select('select * from units');
        $units = (array)$units;


        if ($request->input("id") === "employee") {
            return view('employee/rr_form_edit', compact('results'), compact('units'));
        } else {
            return view('admin/rr_form_edit', compact('results'), compact('units'));
        }
    }

    public function addAckR(Request $request)
    {

        $assetTags = $request->input('asset_tag');
        $assetDesc = $request->input('asset_desc');
        $serialNum = $request->input('serial_no');
        $dates = $request->input('date_purchased');
        $brand = $request->input('brand');
        $model = $request->input('model');


        for ($int = 0; $assetTags[$int] != null; $int++) {
            DB::insert(
                'INSERT INTO acknowledgement_report 
                (name_employee, id_number, ar_no, ar_date, unit, office, cb_record, asset_tag, asset_desc, 
                brand, model, serial_no, date_purchased, amico_prepared_by, amico_prepared_date, amico_noted_by, amico_noted_date,
                ea_ack_by, ea_ack_date, ea_noted_by, ea_noted_date,
                amico_checked_by, amico_checked_date, note, status)   
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                [
                    $request->input('name_employee'),
                    $request->input('id_number'),
                    $request->input('ar_no'),
                    $request->input('ar_date'),
                    $request->input('unit'),
                    $request->input('office'),
                    $request->input('cb_record'),
                    $assetTags[$int],
                    $assetDesc[$int],
                    $brand[$int],
                    $model[$int],
                    $serialNum[$int],
                    \DateTime::createFromFormat('Y-m-d', $dates[$int]) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('amico_prepared_by'),



                    $request->input('amico_prepared_date'),
                    $request->input('amico_noted_by'),
                    $request->input('amico_noted_date'),
                    $request->input('ea_ack_by'),
                    $request->input('ea_ack_date'),
                    $request->input('ea_noted_by'),
                    $request->input('ea_noted_date'),
                    $request->input('amico_checked_by'),
                    $request->input('amico_checked_date'),
                    $request->input('note'),
                    "pending"
                ]

            );
        }

        if ($request->input('user') === 'admin') {
            return redirect("admin/ack_repo");
        } else {
            return redirect("employee/ack_repo");
        }
    }

    public function updateAck(Request $request)
    {
        $assetTags = $request->input('asset_tag');
        $assetDesc = $request->input('asset_desc');
        $serialNum = $request->input('serial_no');
        $dates = $request->input('date_purchased');
        $brand = $request->input('brand');
        $model = $request->input('model');


        // Retrieve all rows matching the condition
        $matchingRows = DB::table('acknowledgement_report')->where('ar_no', $request->input('ar_no'))->get();
        for ($int = 0; $assetTags[$int] != null; $int++) {
            DB::table('acknowledgement_report')
                ->where('ar_id', $matchingRows[$int]->ar_id)
                ->update([
                    'unit' => $request->input('unit'),
                    'office' => $request->input('office'),
                    'cb_record' => $request->input('cb_record'),
                    'asset_desc' => $assetDesc[$int],
                    'brand' => $brand[$int],
                    'model' => $model[$int],
                    'serial_no' => $serialNum[$int],
                    'date_purchased' => \DateTime::createFromFormat('Y-m-d', $dates[$int])->format('Y-m-d'),
                    'amico_prepared_by' => $request->input('amico_prepared_by'),
                    'amico_prepared_date' => $request->input('amico_prepared_date'),
                    'amico_noted_by' => $request->input('amico_noted_by'),
                    'amico_noted_date' => $request->input('amico_noted_date'),
                    'ea_ack_by' => $request->input('ea_ack_by'),
                    'ea_ack_date' => $request->input('ea_ack_date'),
                    'ea_noted_by' => $request->input('ea_noted_by'),
                    'ea_noted_date' => $request->input('ea_noted_date'),
                    'amico_checked_by' => $request->input('amico_checked_by'),
                    'amico_checked_date' => $request->input('amico_checked_date'),
                    'note' => $request->input('note'),
                    'status' => 'pending'
                ]);
        }

        if ($request->input('user') === 'admin') {
            return redirect("admin/ack_repo");
        } else {
            return redirect("employee/ack_repo");
        }
    }

    public function seeAckForm(Request $request)
    {
        $results = DB::select('select * from acknowledgement_report where ar_no = "' . $request->input("ar_no") . '"');
        $results = (array)$results;

        $units = DB::select('select * from units');
        $units = (array)$units;

        if ($request->input("id") === "employee") {
            return view('employee/ack_form_edit', compact('results'), compact('units'));
        } else {
            return view('admin/ack_form_edit', compact('results'), compact('units'));
        }
    }

    public function addProp(Request $request)
    {

        $assetTags = $request->input('asset_tag');
        $assetDesc = $request->input('asset_desc');
        $serialNum = $request->input('serial_no');
        $brand = $request->input('brand');
        $model = $request->input('model');
        $qty = $request->input('qty');
        $uom = $request->input('uom');

        for ($int = 0; $assetTags[$int] != null; $int++) {
            DB::insert(
                'INSERT INTO property_borrowing 
                (person_accountable, id_no, pb_no, pb_date, unit, office, rs_no, rs_date,purpose, 
                period_from,period_until,asset_tag, asset_desc, 
                brand, model, serial_no, qty, uom, amico_prepared_by, amico_prepared_date,amico_noted_by,
                amico_noted_date, provider_issued_by, provider_issued_date, provider_noted_by, provider_noted_date, 
                e_borrow, date_borrowed, borrow_noted_by, borrow_noted_by_date, i_borrow,
                borrower_return_date, borrower_noted_by, borrower_noted_date, ii_borrow, provider_received_by,
                provider_received_date, provider_noted_date_2, iii_borrow, amico_prepared_by_2,
                amico_prepared_date_2, amico_noted_date_2, notes, status)   
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                [
                    $request->input('person_accountable'),
                    $request->input('id_no'),
                    $request->input('pb_no'),
                    $request->input('pb_date'),
                    $request->input('unit'),
                    $request->input('office'),
                    $request->input('rs_no'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('rs_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('purpose'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('period_from')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    \DateTime::createFromFormat('Y-m-d', $request->input('period_until')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $assetTags[$int],
                    $assetDesc[$int],
                    $brand[$int],
                    $model[$int],
                    $serialNum[$int],
                    $qty[$int],
                    $uom[$int],
                    $request->input('amico_prepared_by'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('amico_prepared_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('amico_noted_by'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('amico_noted_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('provider_issued_by'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('provider_issued_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object

                    $request->input('provider_noted_by'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('provider_noted_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('e_borrow'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('date_borrowed')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('borrow_noted_by'),

                    \DateTime::createFromFormat('Y-m-d', $request->input('borrow_noted_by_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('i_borrow'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('borrower_return_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('borrower_noted_by'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('borrower_noted_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('ii_borrow'),
                    $request->input('provider_received_by'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('provider_received_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    \DateTime::createFromFormat('Y-m-d', $request->input('provider_noted_date_2')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('iii_borrow'),
                    $request->input('amico_prepared_by_2'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('amico_prepared_date_2')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    \DateTime::createFromFormat('Y-m-d', $request->input('amico_noted_date_2')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('notes'),
                    "pending"
                ]

            );
        }

        if ($request->input('user') === 'admin') {
            return redirect("admin/prop_borr");
        } else {
            return redirect("employee/prop_borr");
        }
    }

    public function updateProp(Request $request)
    {

        $assetTags = $request->input('asset_tag');
        $assetDesc = $request->input('asset_desc');
        $serialNum = $request->input('serial_no');
        $brand = $request->input('brand');
        $model = $request->input('model');
        $qty = $request->input('qty');
        $uom = $request->input('uom');

        // Retrieve all rows matching the condition
        $matchingRows = DB::table('receiving_report')->where('pb_no', $request->input('pb_no'))->get();
        for ($int = 0; $assetTags[$int] != null; $int++) {
            DB::update(
                'UPDATE property_borrowing 
                SET person_accountable = ?, id_no = ?, pb_no = ?, pb_date = ?, unit = ?, office = ?, rs_no = ?, rs_date = ?, purpose = ?, 
                    period_from = ?, period_until = ?, asset_tag = ?, asset_desc = ?, brand = ?, model = ?, serial_no = ?, qty = ?, uom = ?, 
                    amico_prepared_by = ?, amico_prepared_date = ?, amico_noted_by = ?, amico_noted_date = ?, provider_issued_by = ?, 
                    provider_issued_date = ?, provider_noted_by = ?, provider_noted_date = ?, e_borrow = ?, date_borrowed = ?, 
                    borrow_noted_by = ?, borrow_noted_by_date = ?, i_borrow = ?, borrower_return_date = ?, borrower_noted_by = ?, 
                    borrower_noted_date = ?, ii_borrow = ?, provider_received_by = ?, provider_received_date = ?, provider_noted_date_2 = ?, 
                    iii_borrow = ?, amico_prepared_by_2 = ?, amico_prepared_date_2 = ?, amico_noted_date_2 = ?, notes = ?, status = ?
                WHERE pb_id = ?',
                [
                    $request->input('person_accountable'),
                    $request->input('id_no'),
                    $request->input('pb_no'),
                    $request->input('pb_date'),
                    $request->input('unit'),
                    $request->input('office'),
                    $request->input('rs_no'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('rs_date'))->format('Y-m-d'),
                    $request->input('purpose'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('period_from'))->format('Y-m-d'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('period_until'))->format('Y-m-d'),
                    $assetTags[$int],
                    $assetDesc[$int],
                    $brand[$int],
                    $model[$int],
                    $serialNum[$int],
                    $qty[$int],
                    $uom[$int],
                    $request->input('amico_prepared_by'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('amico_prepared_date'))->format('Y-m-d'),
                    $request->input('amico_noted_by'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('amico_noted_date'))->format('Y-m-d'),
                    $request->input('provider_issued_by'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('provider_issued_date'))->format('Y-m-d'),
                    $request->input('provider_noted_by'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('provider_noted_date'))->format('Y-m-d'),
                    $request->input('e_borrow'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('date_borrowed'))->format('Y-m-d'),
                    $request->input('borrow_noted_by'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('borrow_noted_by_date'))->format('Y-m-d'),
                    $request->input('i_borrow'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('borrower_return_date'))->format('Y-m-d'),
                    $request->input('borrower_noted_by'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('borrower_noted_date'))->format('Y-m-d'),
                    $request->input('ii_borrow'),
                    $request->input('provider_received_by'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('provider_received_date'))->format('Y-m-d'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('provider_noted_date_2'))->format('Y-m-d'),
                    $request->input('iii_borrow'),
                    $request->input('amico_prepared_by_2'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('amico_prepared_date_2'))->format('Y-m-d'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('amico_noted_date_2'))->format('Y-m-d'),
                    $request->input('notes'),
                    "pending",
                    $matchingRows[$int]->pb_id
                ]
            );
        }

        if ($request->input('user') === 'admin') {
            return redirect("admin/prop_borr");
        } else {
            return redirect("employee/prop_borr");
        }
    }


    public function seePropBorr(Request $request)
    {
        $results = DB::select('select * from property_borrowing where pb_no = "' . $request->input("pb_no") . '"');
        $results = (array)$results;

        $units = DB::select('select * from units');
        $units = (array)$units;

        if ($request->input("id") === "employee") {
            return view('employee/prop_borr_edit', compact('results'), compact('units'));
        } else {
            return view('admin/prop_borr_edit', compact('results'), compact('units'));
        }
    }


    public function addMain(Request $request)
    {

        $assetTags = $request->input('asset_tag');
        $assetDesc = $request->input('asset_desc');
        $serialNum = $request->input('serial_no');
        $brand = $request->input('brand');
        $model = $request->input('model');
        $last_maintenance = $request->input('last_maintenance');

        $notes = $request->input('notes');
        $allNotes = " ";
        foreach ($notes as $note) {
            if ($note != null) {
                $allNotes = $allNotes . $note . "|||";
            }
        }


        for ($int = 0; $assetTags[$int] != null; $int++) {
            DB::insert(
                'INSERT INTO maintenance_report 
                (unit, office, unit_code, ms_no, ms_date,rs_no, 
                rs_date,cb_maintenance,cb_warranty_po_no, cb_warranty_po_date, 
                supplier, asset_tag, asset_desc, brand, model, serial_no, last_maintenance,amico_checked_by,
                amico_checked_date, amico_noted_by, amico_noted_date, cb_covered_warranty, cb_tmdd, 
                cb_lab_tech, cb_cpmsd, cb_service_center, cb_other, notes,status)   
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                [
                    $request->input('unit'),
                    $request->input('office'),
                    $request->input('unit_code'),
                    $request->input('ms_no'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('ms_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('rs_no'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('rs_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('cb_maintenance'),
                    $request->input('cb_warranty_po_no'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('cb_warranty_po_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object

                    $request->input('supplier'),
                    $assetTags[$int],
                    $assetDesc[$int],
                    $brand[$int],
                    $model[$int],
                    $serialNum[$int],
                    $last_maintenance[$int],
                    $request->input('amico_checked_by'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('amico_checked_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('amico_noted_by'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('amico_noted_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('cb_covered_warranty'),
                    $request->input('cb_tmdd'),
                    $request->input('cb_lab_tech'),
                    $request->input('cb_cpmsd'),
                    $request->input('cb_service_center'),
                    $request->input('cb_other'),
                    $allNotes,
                    "pending"
                ]

            );
        }

        if ($request->input('user') === 'admin') {
            return redirect("admin/main_req");
        } else {
            return redirect("employee/main_req");
        }
    }

    public function seeMain(Request $request)
    {
        $results = DB::select('select * from maintenance_report where ms_no = "' . $request->input("ms_no") . '"');
        $results = (array)$results;

        $units = DB::select('select * from units');
        $units = (array)$units;

        if ($request->input("id") === "employee") {
            return view('employee/main_form_edit', compact('results'), compact('units'));
        } else {
            return view('admin/main_form_edit', compact('results'), compact('units'));
        }
    }

    public function updateMain(Request $request)
    {

        $assetTags = $request->input('asset_tag');
        $assetDesc = $request->input('asset_desc');
        $serialNum = $request->input('serial_no');
        $brand = $request->input('brand');
        $model = $request->input('model');
        $lastMaintenance = $request->input('last_maintenance');

        $notes = $request->input('notes');
        $allNotes = " ";
        foreach ($notes as $note) {
            if ($note != null) {
                $allNotes = $allNotes . $note . "|||";
            }
        }



        // Retrieve all rows matching the condition
        $matchingRows = DB::table('maintenance_report')->where('ms_no', $request->input('ms_no'))->get();
        for ($int = 0; $assetTags[$int] != null; $int++) {
            DB::table('maintenance_report')
                ->where('ms_id', $matchingRows[$int]->ms_id)
                ->update([
                    'unit' => $request->input('unit'),
                    'office' => $request->input('office'),
                    'unit_code' => $request->input('unit_code'),
                    'ms_no' => $request->input('ms_no'),
                    'ms_date' => \DateTime::createFromFormat('Y-m-d', $request->input('ms_date'))->format('Y-m-d'),
                    'rs_no' => $request->input('rs_no'),
                    'rs_date' => \DateTime::createFromFormat('Y-m-d', $request->input('rs_date'))->format('Y-m-d'),
                    'cb_maintenance' => $request->input('cb_maintenance'),
                    'cb_warranty_po_no' => $request->input('cb_warranty_po_no'),
                    'cb_warranty_po_date' => \DateTime::createFromFormat('Y-m-d', $request->input('cb_warranty_po_date'))->format('Y-m-d'),
                    'supplier' => $request->input('supplier'),
                    'asset_desc' => $assetDesc[$int],
                    'brand' => $brand[$int],
                    'model' => $model[$int],
                    'serial_no' => $serialNum[$int],
                    'last_maintenance' => $lastMaintenance[$int],
                    'amico_checked_by' => $request->input('amico_checked_by'),
                    'amico_checked_date' => \DateTime::createFromFormat('Y-m-d', $request->input('amico_checked_date'))->format('Y-m-d'),
                    'amico_noted_by' => $request->input('amico_noted_by'),
                    'amico_noted_date' => \DateTime::createFromFormat('Y-m-d', $request->input('amico_noted_date'))->format('Y-m-d'),
                    'cb_covered_warranty' => $request->input('cb_covered_warranty'),
                    'cb_tmdd' => $request->input('cb_tmdd'),
                    'cb_lab_tech' => $request->input('cb_lab_tech'),
                    'cb_cpmsd' => $request->input('cb_cpmsd'),
                    'cb_service_center' => $request->input('cb_service_center'),
                    'cb_other' => $request->input('cb_other'),
                    'notes' => $allNotes,
                    'status' => 'pending'
                ]);
        }

        if ($request->input('user') === 'admin') {
            return redirect("admin/main_req");
        } else {
            return redirect("employee/main_req");
        }
    }

    public function addCond(Request $request)
    {

        $assetTags = $request->input('asset_tag');
        $assetDesc = $request->input('asset_desc');
        $serialNum = $request->input('serial_no');
        $brand = $request->input('brand');
        $model = $request->input('model');
        $date_acq = $request->input('date_acq');

        $notes = $request->input('notes');
        $allNotes = " ";
        foreach ($notes as $note) {
            if ($note != null) {
                $allNotes = $allNotes . $note . "|||";
            }
        }
        Log::info($request->input('cr_date'));

        for ($int = 0; $assetTags[$int] != null; $int++) {
            DB::insert(
                'INSERT INTO condemnation
                (unit, office, unit_code, cr_no, cr_date,rs_no, 
                rs_date,cb_condition,asset_tag, asset_desc, brand, model, serial_no, date_acq,amico_prepared_by,
                amico_prepared_date, amico_noted_by, amico_noted_date, fo_rec_copy_by, fo_rec_date, notes, status)   
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                [
                    $request->input('unit'),
                    $request->input('office'),
                    $request->input('unit_code'),
                    $request->input('cr_no'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('cr_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('rs_no'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('rs_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('cb_condition'),
                    $assetTags[$int],
                    $assetDesc[$int],
                    $brand[$int],
                    $model[$int],
                    $serialNum[$int],
                    \DateTime::createFromFormat('Y-m-d',  $date_acq[$int]) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('amico_prepared_by'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('amico_prepared_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('amico_noted_by'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('amico_noted_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('fo_rec_copy_by'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('fo_rec_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $allNotes,
                    "pending"
                ]

            );
        }

        if ($request->input('user') === 'admin') {
            return redirect("admin/condemn_req");
        } else {
            return redirect("employee/condemn_req");
        }
    }

    public function seeCondemn(Request $request)
    {
        $results = DB::select('select * from condemnation where cr_no = "' . $request->input("cr_no") . '"');
        $results = (array)$results;

        $units = DB::select('select * from units');
        $units = (array)$units;

        if ($request->input("id") === "employee") {
            return view('employee/condemn_form_edit', compact('results'), compact('units'));
        } else {
            return view('admin/condemn_form_edit', compact('results'), compact('units'));
        }
    }

    public function updateCond(Request $request)
    {

        $assetTags = $request->input('asset_tag');
        $assetDesc = $request->input('asset_desc');
        $serialNum = $request->input('serial_no');
        $brand = $request->input('brand');
        $model = $request->input('model');
        $dateAcq = $request->input('date_acq');

        $notes = $request->input('notes');
        $allNotes = " ";
        foreach ($notes as $note) {
            if ($note != null) {
                $allNotes = $allNotes . $note . "|||";
            }
        }

        Log::info($request->input('cr_date'));


        // Retrieve all rows matching the condition
        $matchingRows = DB::table('condemnation')->where('cr_no', $request->input('cr_no'))->get();
        for ($int = 0; $assetTags[$int] != null; $int++) {
            DB::table('condemnation')
                ->where('cr_id', $matchingRows[$int]->cr_id)
                ->where('asset_tag', $assetTags[$int]) // Add condition for updating the correct row
                ->update([
                    'unit' => $request->input('unit'),
                    'office' => $request->input('office'),
                    'unit_code' => $request->input('unit_code'),
                    'cr_no' => $request->input('cr_no'),
                    'cr_date' => \DateTime::createFromFormat('Y-m-d', $request->input('cr_date'))->format('Y-m-d'),
                    'rs_no' => $request->input('rs_no'),
                    'rs_date' => \DateTime::createFromFormat('Y-m-d', $request->input('rs_date'))->format('Y-m-d'),
                    'cb_condition' => $request->input('cb_condition'),
                    'asset_tag' => $assetTags[$int],
                    'asset_desc' => $assetDesc[$int],
                    'brand' => $brand[$int],
                    'model' => $model[$int],
                    'serial_no' => $serialNum[$int],
                    'date_acq' =>   \DateTime::createFromFormat('Y-m-d',  $dateAcq[$int]) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    'amico_prepared_by' => $request->input('amico_prepared_by'),
                    'amico_prepared_date' => \DateTime::createFromFormat('Y-m-d', $request->input('amico_prepared_date'))->format('Y-m-d'),
                    'amico_noted_by' => $request->input('amico_noted_by'),
                    'amico_noted_date' => \DateTime::createFromFormat('Y-m-d', $request->input('amico_noted_date'))->format('Y-m-d'),
                    'fo_rec_copy_by' => $request->input('fo_rec_copy_by'),
                    'fo_rec_date' => \DateTime::createFromFormat('Y-m-d', $request->input('fo_rec_date'))->format('Y-m-d'),
                    'notes' => $allNotes,
                    'status' => 'pending'
                ]);
        }

        if ($request->input('user') === 'admin') {
            return redirect("admin/condemn_req");
        } else {
            return redirect("employee/condemn_req");
        }
    }


    public function addCalib(Request $request)
    {

        $assetTags = $request->input('asset_tag');
        $assetDesc = $request->input('asset_desc');
        $serialNum = $request->input('serial_no');
        $brand = $request->input('brand');
        $model = $request->input('model');
        $last_maintenance = $request->input('last_maintenance');

        $notes = $request->input('notes');
        $allNotes = " ";
        foreach ($notes as $note) {
            if ($note != null) {
                $allNotes = $allNotes . $note . "|||";
            }
        }


        for ($int = 0; $assetTags[$int] != null; $int++) {
            DB::insert(
                'INSERT INTO calibration 
                (unit, office, unit_code, cs_no, cs_date,rs_no, 
                rs_date,cb_calibration,warranty_po_no, warranty_po_date, 
                supplier, asset_tag, asset_desc, brand, model, serial_no, date_last_calibration,amico_checked_by,
                amico_checked_date, amico_noted_by, amico_noted_date, cb_covered_warranty, cb_tmdd, 
                cb_lab_tech, cb_cpmsd, cb_service_center, cb_other, notes,status)   
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                [
                    $request->input('unit'),
                    $request->input('office'),
                    $request->input('unit_code'),
                    $request->input('ms_no'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('ms_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('rs_no'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('rs_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('cb_maintenance'),
                    $request->input('cb_warranty_po_no'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('cb_warranty_po_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object

                    $request->input('supplier'),
                    $assetTags[$int],
                    $assetDesc[$int],
                    $brand[$int],
                    $model[$int],
                    $serialNum[$int],
                    $last_maintenance[$int],
                    $request->input('amico_checked_by'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('amico_checked_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('amico_noted_by'),
                    \DateTime::createFromFormat('Y-m-d', $request->input('amico_noted_date')) // Convert the string to a DateTime object
                        ->format('Y-m-d'), // Format the DateTime object
                    $request->input('cb_covered_warranty'),
                    $request->input('cb_tmdd'),
                    $request->input('cb_lab_tech'),
                    $request->input('cb_cpmsd'),
                    $request->input('cb_service_center'),
                    $request->input('cb_other'),
                    $allNotes,
                    "pending"
                ]

            );
        }

        if ($request->input('user') === 'admin') {
            return redirect("admin/calib_req");
        } else {
            return redirect("employee/calib_req");
        }
    }

    public function seeCalib(Request $request)
    {
        $results = DB::select('select * from calibration where cs_no = "' . $request->input("cs_no") . '"');
        $results = (array)$results;

        $units = DB::select('select * from units');
        $units = (array)$units;

        if ($request->input("id") === "employee") {
            return view('employee/calib_form_edit', compact('results'), compact('units'));
        } else {
            return view('admin/calib_form_edit', compact('results'), compact('units'));
        }
    }


    public function updateCalib(Request $request)
    {

        $assetTags = $request->input('asset_tag');
        $assetDesc = $request->input('asset_desc');
        $serialNum = $request->input('serial_no');
        $brand = $request->input('brand');
        $model = $request->input('model');
        $lastMaintenance = $request->input('last_maintenance');

        $notes = $request->input('notes');
        $allNotes = " ";
        foreach ($notes as $note) {
            if ($note != null) {
                $allNotes = $allNotes . $note . "|||";
            }
        }

        // Retrieve all rows matching the condition
        $matchingRows = DB::table('calibration')->where('cs_no', $request->input('cs_no'))->get();
        for ($int = 0; $assetTags[$int] != null; $int++) {
            DB::table('calibration')
                ->where('cs_id', $matchingRows[$int]->cs_id)
                ->where('asset_tag', $assetTags[$int]) // Add condition for updating the correct row
                ->update([
                    'unit' => $request->input('unit'),
                    'office' => $request->input('office'),
                    'unit_code' => $request->input('unit_code'),
                    'cs_no' => $request->input('ms_no'),
                    'cs_date' => \DateTime::createFromFormat('Y-m-d', $request->input('ms_date'))->format('Y-m-d'),
                    'rs_no' => $request->input('rs_no'),
                    'rs_date' => \DateTime::createFromFormat('Y-m-d', $request->input('rs_date'))->format('Y-m-d'),
                    'cb_calibration' => $request->input('cb_maintenance'),
                    'warranty_po_no' => $request->input('cb_warranty_po_no'),
                    'warranty_po_date' => \DateTime::createFromFormat('Y-m-d', $request->input('cb_warranty_po_date'))->format('Y-m-d'),

                    'supplier' => $request->input('supplier'),
                    'asset_tag' => $assetTags[$int],
                    'asset_desc' => $assetDesc[$int],
                    'brand' => $brand[$int],
                    'model' => $model[$int],
                    'serial_no' => $serialNum[$int],
                    'date_last_calibration' => $lastMaintenance[$int],
                    'amico_checked_by' => $request->input('amico_checked_by'),
                    'amico_checked_date' => \DateTime::createFromFormat('Y-m-d', $request->input('amico_checked_date'))->format('Y-m-d'),
                    'amico_noted_by' => $request->input('amico_noted_by'),
                    'amico_noted_date' => \DateTime::createFromFormat('Y-m-d', $request->input('amico_noted_date'))->format('Y-m-d'),
                    'cb_covered_warranty' => $request->input('cb_covered_warranty'),
                    'cb_tmdd' => $request->input('cb_tmdd'),
                    'cb_lab_tech' => $request->input('cb_lab_tech'),
                    'cb_cpmsd' => $request->input('cb_cpmsd'),
                    'cb_service_center' => $request->input('cb_service_center'),
                    'cb_other' => $request->input('cb_other'),
                    'notes' => $allNotes,
                    'status' => 'pending'
                ]);
        }

        if ($request->input('user') === 'admin') {
            return redirect("admin/calib_req");
        } else {
            return redirect("employee/calib_req");
        }
    }

    public function addToAssetInfo(Request $request)
    {

        $matchingRows = DB::table('receiving_report')->where('rr_no', $request->input('rr_no'))->get();
        foreach ($matchingRows as $row) {
            DB::insert(
                'INSERT INTO asset 
                (unit_code, asset_tag, asset_desc, brand, model, serial_no, asset_class, status, rr_no, 
                date_acq, reference, reference_date,funded_by,
                received_from, received_by)   
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                [
                    $row->unit_code,
                    $row->asset_tag,
                    $row->asset_desc,
                    $row->brand,
                    $row->model,
                    $row->serial_no,
                    $row->asset_class,
                    "accepted",
                    $row->rr_no,
                    \DateTime::createFromFormat('Y-m-d', $row->date_acq)->format('Y-m-d'),
                    $row->reference,
                    \DateTime::createFromFormat('Y-m-d', $row->reference_date)->format('Y-m-d'),
                    $row->funded_by,
                    $row->received_from,
                    $row->received_by
                ]
            );

            DB::table('receiving_report')
                ->where('rr_id', $row->rr_id)
                ->update([
                    'req_status' => "accepted",
                ]);
        }
       
            return redirect("admin/receiving_repo");
      
    }

    public function addToAck(Request $request)
    {

        $matchingRows = DB::table('acknowledgement_report')->where('ar_no', $request->input('ar_no'))->get();
        foreach ($matchingRows as $row) {
            DB::table('asset')
                ->where('serial_no', $row->serial_no)
                ->update([
                    "ar_no" => $row->ar_no,
                    "ar_date" => \DateTime::createFromFormat('Y-m-d', $row->ar_date)->format('Y-m-d'),
                    "id_number" =>  $row->id_number,
                    "name_employee" =>  $row->name_employee,
                    "status" => "acknowledged"

                ]);

            DB::table('acknowledgement_report')
                ->where('ar_id', $row->ar_id)
                ->update([
                    'status' => "accepted",
                ]);
        }
     
            return redirect("admin/ack_repo");
      
    }


    public function addToProp(Request $request)
    {

        $matchingRows = DB::table('property_borrowing')->where('pb_no', $request->input('pb_no'))->get();
        foreach ($matchingRows as $row) {
            DB::table('asset')
                ->where('serial_no', $row->serial_no)
                ->update([
                    "pb_no" => $row->pb_no,
                    "pb_date" => \DateTime::createFromFormat('Y-m-d', $row->pb_date)->format('Y-m-d'),
                    "id_no" =>  $row->id_no,
                    "person_accountable" =>  $row->person_accountable,
                    "status" => "borrowed"

                ]);
            DB::table('property_borrowing')
                ->where('pb_id', $row->pb_id)
                ->update([
                    'status' => "accepted",
                ]);
        }
            return redirect("admin/receiving_repo");
      
    }


    public function addToMain(Request $request)
    {

        $matchingRows = DB::table('maintenance_report')->where('ms_no', $request->input('ms_no'))->get();
        foreach ($matchingRows as $row) {

            DB::table('asset')
                ->where('serial_no', $row->serial_no)
                ->update([
                    "ms_no" => $row->ms_no,
                    "ms_date" => \DateTime::createFromFormat('Y-m-d', $row->ms_date)->format('Y-m-d'),
                    "moni_log" =>  $row->moni_log,
                    "status" => "maintenance"

                ]);


            DB::table('maintenance_report')
                ->where('ms_id', $row->ms_id)
                ->update([
                    'status' => "accepted",
                ]);
        }
            return redirect("admin/main_req");
       
    }


    public function addToCondemn(Request $request)
    {

        $matchingRows = DB::table('condemnation')->where('cr_no', $request->input('cr_no'))->get();
        foreach ($matchingRows as $row) {
            DB::table('asset')
                ->where('serial_no', $row->serial_no)
                ->update([
                    "cr_no" => $row->cr_no,
                    "cr_date" => \DateTime::createFromFormat('Y-m-d', $row->cr_date)->format('Y-m-d'),
                    "remarks" =>  $row->notes,
                    "status" => "condemned"

                ]);


            DB::table('condemnation')
                ->where('cr_id', $row->cr_id)
                ->update([
                    'status' => "accepted",
                ]);
        }
      
            return redirect("admin/condemn_req");
        
    }


    public function addToCalib(Request $request)
    {

        $matchingRows = DB::table('calibration')->where('cs_no', $request->input('cs_no'))->get();
        foreach ($matchingRows as $row) {
            DB::table('asset')
                ->where('serial_no', $row->serial_no)
                ->update([
                    "cs_no" => $row->cs_no,
                    "cs_date" => \DateTime::createFromFormat('Y-m-d', $row->cs_date)->format('Y-m-d'),
                    "status" => "calibrated"

                ]);

            DB::table('calibration')
                ->where('cs_id', $row->cs_id)
                ->update([
                    'status' => "accepted",
                ]);
        }
      
            return redirect("admin/calib_req");
      
    }


    public function declineRequest(Request $request)
    {
        $number = $request->input('serial_no');

        DB::table('receiving_report')
            ->where('serial_no', $number)
            ->update(['req_status' => 'declined']);

        return redirect("admin/pending");
    }

    public function editAsset(Request $request)
    {



        $pressedButton = $request['button_pressed'];


        $serial_name = "serial_no$pressedButton";
        $number = $request->input($serial_name);

        if ($request->input('user_id') != null) {
            DB::table('receiving_report')
                ->where('serial_no', $number)
                ->update([
                    'rr_no' => $request->input('rr_no'),
                    'rs_date' => $request->input('rs_date'),
                    'doc_no' => $request->input('doc_no'),
                    'date_rec' => $request->input('date_rec'),
                    'from_loc' => $request->input('from_loc'),
                    'from_don' => $request->input('from_don'),
                    'date_acq' => $request->input('date_acq'),
                    'user_id' => $request->input('user_id')
                ]);
        } else {
            DB::table('receiving_report')
                ->where('serial_no', $number)
                ->update([
                    'rr_no' => $request->input('rr_no'),
                    'rr_date' => $request->input('rr_date'),
                    'po_no' => $request->input('po_no'),
                    'po_date' => $request->input('po_date'),
                    'serial_no' => $request->input('serial_no'),
                    'asset_desc' => $request->input('asset_desc'),
                    'funded_by' => $request->input('funded_by'),
                    'rs_no' => $request->input('rs_no')
                ]);
        }


        if ($request->input('user') === 'admin') {
            return redirect("admin/receiving_repo");
        } else {
            if ($request->input('req_status') === 'pending') {
                return redirect("employee/pending");
            } else {
                return redirect("employee/receiving_repo");
            }
        }
    }

public function deleteAsset(Request $request)
{
    try{ 
    $serialNo = $request->input('serial_no');
    \Log::info('Serial no to be deleted: ' . $serialNo);
    // dd($request->serial_no);

    DB::table('asset')->where('serial_no', $serialNo)->delete();

    return response()->json(['message' => 'Asset deleted successfully']);

} catch (\Exception $e) {
    \Log::error('Error deleting asset: ' . $e->getMessage());
    \Log::error($e->getTraceAsString());

    return response()->json(['error' => 'An error occurred during asset deletion'], 500);
    }
}
}