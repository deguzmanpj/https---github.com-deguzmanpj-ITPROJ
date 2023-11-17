<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
{
    try {
        $unitFilter = $request->input('unit');

        $assetStatusQuery = DB::table('asset');

        // Apply unit filter only if a specific unit is selected
        if ($unitFilter !== null) {
            $assetStatusQuery->where('unit', $unitFilter);
        }

        // Define the list of statuses to filter
        $statuses = ['condemned', 'maintenance', 'borrowed', 'calibration', 'acknowledged'];

        // Use a single select statement with CASE statements for conditional counting
        $assetStatusQuery->select(
            DB::raw('COUNT(CASE WHEN `status` = "condemned" THEN 1 END) as condemned'),
            DB::raw('COUNT(CASE WHEN `status` = "maintenance" THEN 1 END) as maintenance'),
            DB::raw('COUNT(CASE WHEN `status` = "borrowed" THEN 1 END) as borrowed'),
            DB::raw('COUNT(CASE WHEN `status` = "calibration" THEN 1 END) as calibration'),
            DB::raw('COUNT(CASE WHEN `status` = "acknowledged" THEN 1 END) as acknowledged')
        );

            // Fetch counts
            $assetStatusCounts = $assetStatusQuery->first();

            // Debugging: Output counts for each status
            echo "Condemned Count: {$assetStatusCounts->condemned}\n";
            echo "Maintenance Count: {$assetStatusCounts->maintenance}\n";
            echo "Borrowed Count: {$assetStatusCounts->borrowed}\n";
            echo "Calibration Count: {$assetStatusCounts->calibration}\n";
            echo "Acknowledged Count: {$assetStatusCounts->acknowledged}\n";

            // Uncomment the line below to see the generated SQL query
            // dd($assetStatusQuery->toSql());

            return view('admin.dash', compact('assetStatusCounts', 'unitFilter'));
        } catch (\Exception $e) {
            // Log or handle the exception as needed
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}