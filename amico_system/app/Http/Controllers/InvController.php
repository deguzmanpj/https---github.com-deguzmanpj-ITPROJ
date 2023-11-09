<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use res\js\asset_information;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class InvController extends Controller
{
    public function showDashboard()
    {

        // $output = new \Symfony\Component\Console\Output\ConsoleOutput();
        // $output->writeln(request('password'));

        $number = request('number');

        $role = DB::table('users')
            ->where('contact_no', $number)
            ->select('role')
            ->first(); //retrieve the first record (row) that matches the query criteria

        // Access the "role" property of the $role object and convert it to a string
        $roleAsString = $role->role;

        if ($roleAsString == "admin") {
            return redirect("admin/asset_info");
        } else if ($roleAsString == "employee") {
            return redirect("employee/asset_info");
        } else {
        }
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

        $remarks = $request->input('remarks');
        $allRemarks = "";
        foreach($remarks as $remark){
            $allRemarks += $remark + ",";
        }

        $notes = $request->input('notes');
        $allNotes = "";
        foreach($notes as $note){
            $allNotes += $note + ",";
        }


        Log::info($request->input('fo_rec_date'));

        for ($int = 0; $assetTags[$int] != null; $int++) {
            DB::insert(
                'INSERT INTO receiving_report 
                (unit, unit_code, office, rr_no, cb_purchase_goods_services, cb_transfer_property_equipment, cb_donation, 
                cb_grant, cb_other, reference, reference_date, received_from, ref_received_from, date_acq, asset_tag, asset_desc, 
                brand, model, serial_no, asset_class, qty, uom, funded_by, received_by,
                checked_by, amico_prepared_by, amico_prepared_by_date, amico_noted_by, amico_noted_by_date,
                req_status, au_cpmsd, au_tmdd, au_other, au_received_by, au_received_date,
                au_condition, au_remarks, au_checked_by, au_checked_by_date, au_noted_by, au_noted_by_date, ua_ack_by,
                ua_ack_by_position, ua_ack_by_date, fo_rec_copy_by, fo_rec_date, notes)   
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
                ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                [
                    $request->input('unit'),
                    $request->input('unit_code'),
                    $request->input('office'),
                    $request->input('rr_no'),
                    $request->input('cb_purchase_goods_services'),
                    $request->input('cb_transfer_property_equipment'),
                    $request->input('cb_donation'),
                    $request->input('cb_grant'),
                    $request->input('cb_other'),
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
                    $request->input('au_cpmsd'),
                    $request->input('au_tmdd'),
                    $request->input('au_other'),
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

    public function seeForm(Request $request)
    {
        $results = DB::select('select * from receiving_report where rr_no = "' . $request->input("rr_no") . '"');
        $results = (array)$results;
        Log::info($results[0]->unit);
        if($request->input("id") === "employee"){
            return view('employee/rr_form_edit', compact('results'));
        }
        else{
            return view('admin/rr_form_edit', compact('results'));
        }
        
    }

    public function addToAssetInfo(Request $request)
    {
        $assetTags = $request->input('asset_tag');
        $assetDesc = $request->input('asset_desc');
        $serialNum = $request->input('serial_no');
        $assetClass = $request->input('asset_class');
        $brand = $request->input('brand');
        $model = $request->input('model');
        $qty = $request->input('qty');
        $uom = $request->input('uom');

        $remarks = $request->input('remarks');
        $allRemarks = "";
        foreach($remarks as $remark){
            $allRemarks += $remark + ",";
        }

        $notes = $request->input('notes');
        $allNotes = "";
        foreach($notes as $note){
            $allNotes += $note + ",";
        }


        Log::info($request->input('fo_rec_date'));

        for ($int = 0; $assetTags[$int] != null; $int++) {
            DB::insert(
                'INSERT INTO receiving_report 
                (unit, unit_code, office, rr_no, cb_purchase_goods_services, cb_transfer_property_equipment, cb_donation, 
                cb_grant, cb_other, reference, reference_date, received_from, ref_received_from, date_acq, asset_tag, asset_desc, 
                brand, model, serial_no, asset_class, qty, uom, funded_by, received_by,
                checked_by, amico_prepared_by, amico_prepared_by_date, amico_noted_by, amico_noted_by_date,
                req_status, au_cpmsd, au_tmdd, au_other, au_received_by, au_received_date,
                au_condition, au_remarks, au_checked_by, au_checked_by_date, au_noted_by, au_noted_by_date, ua_ack_by,
                ua_ack_by_position, ua_ack_by_date, fo_rec_copy_by, fo_rec_date, notes)   
                VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
                ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                [
                    $request->input('unit'),
                    $request->input('unit_code'),
                    $request->input('office'),
                    $request->input('rr_no'),
                    $request->input('cb_purchase_goods_services'),
                    $request->input('cb_transfer_property_equipment'),
                    $request->input('cb_donation'),
                    $request->input('cb_grant'),
                    $request->input('cb_other'),
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
                    $request->input('au_cpmsd'),
                    $request->input('au_tmdd'),
                    $request->input('au_other'),
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
        $number = $request->input('serial_no');

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
}
