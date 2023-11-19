<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset; // Import your Asset model

class AssetSearchController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        
        // Perform the search logic using the Asset model
        $results = asset::where('unit', 'like', "%$searchTerm%")
            ->orWhere('unit_code', 'like', "%$searchTerm%")
            ->orWhere('asset_tag', 'like', "%$searchTerm%")
            ->orWhere('asset_desc', 'like', "%$searchTerm%")
            ->orWhere('brand', 'like', "%$searchTerm%")
            ->orWhere('model', 'like', "%$searchTerm%")
            ->orWhere('serial_no', 'like', "%$searchTerm%")
            ->orWhere('asset_class', 'like', "%$searchTerm%")
            ->orWhere('status', 'like', "%$searchTerm%")
            ->orWhere('cost', 'like', "%$searchTerm%")
            ->orWhere('warranty', 'like', "%$searchTerm%")
            ->orWhere('build_loc', 'like', "%$searchTerm%")
            ->orWhere('floor', 'like', "%$searchTerm%")
            ->orWhere('spec_area', 'like', "%$searchTerm%")
            ->orWhere('note', 'like', "%$searchTerm%")
            ->orWhere('rr_no', 'like', "%$searchTerm%")
            ->orWhere('date_acq', 'like', "%$searchTerm%")
            ->orWhere('reference', 'like', "%$searchTerm%")
            ->orWhere('reference_date', 'like', "%$searchTerm%")
            ->orWhere('funded_by', 'like', "%$searchTerm%")
            ->orWhere('rs_no_transferred', 'like', "%$searchTerm%")
            ->orWhere('rs_date', 'like', "%$searchTerm%")
            ->orWhere('from_loc', 'like', "%$searchTerm%")
            ->orWhere('doc_no', 'like', "%$searchTerm%")
            ->orWhere('doc_no_date', 'like', "%$searchTerm%")
            ->orWhere('received_from', 'like', "%$searchTerm%")
            ->orWhere('received_by', 'like', "%$searchTerm%")
            ->orWhere('pb_no', 'like', "%$searchTerm%")
            ->orWhere('pb_date', 'like', "%$searchTerm%")
            ->orWhere('id_no', 'like', "%$searchTerm%")
            ->orWhere('person_accountable', 'like', "%$searchTerm%")
            ->orWhere('ms_no', 'like', "%$searchTerm%")
            ->orWhere('ms_date', 'like', "%$searchTerm%")
            ->orWhere('moni_log', 'like', "%$searchTerm%")
            ->orWhere('cr_no', 'like', "%$searchTerm%")
            ->orWhere('cr_date', 'like', "%$searchTerm%")
            ->orWhere('remarks', 'like', "%$searchTerm%")
            ->orWhere('ar_no', 'like', "%$searchTerm%")
            ->orWhere('ar_date', 'like', "%$searchTerm%")
            ->orWhere('id_number', 'like', "%$searchTerm%")
            ->orWhere('name_employee', 'like', "%$searchTerm%")
            ->orWhere('cs_no', 'like', "%$searchTerm%")
            ->orWhere('cs_date', 'like', "%$searchTerm%")
            ->orWhere('moni_log_calibration', 'like', "%$searchTerm%")
            ->get();

        // Return the filtered results to the view
        return response()->json($results);
    }
}
