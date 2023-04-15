<?php

namespace App\Http\Controllers;

use App\Models\OperationModel;
use App\Models\SectorModel;
use App\Models\SectorOperationModel;
use App\Models\SectorOperationUserModel;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class SectorOperationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sectors = SectorModel::all();
        $operations = OperationModel::all();
        $sector_operations = SectorOperationModel::with('getSurgeons')->get();
        $data = [
            'sectors' => $sectors,
            'operations' => $operations,
            'sector_operations' => $sector_operations
        ];
        return view('main.sector_operation', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function addSectorOperation(Request $request)
    {
        $sector_id = $request->sector_id;
        $operations = $request->operation_id_list;
        if ($sector_id != null && $operations != null)
            if (count($operations) != 0) {
                foreach ($operations as $operation) {
                    $data[] = ['sector_id' => $sector_id, 'operation_id' => $operation];
                }
            }
        return redirect()->back();
    }

    public function getSurgeonsWithSectorOperationId(Request $request)
    {
        $sector_operation_id = $request->id;
        $models = SectorOperationUserModel::getSurgeonsWithSectorOperationId($sector_operation_id);
        return response()->json($models);
    }

    public function addSurgeonToSectorOperation(Request $request)
    {
        $surgeon_id = $request->surgeon_id;
        $sector_operation_id = $request->sector_operation_id;
        if ($surgeon_id != null && $sector_operation_id != null) {
            SectorOperationUserModel::create(
                [
                    'surgeon_id' => $surgeon_id,
                    'sector_operation_id' => $sector_operation_id
                ]
            );
            return back();
        }
    }

    function deleteSurgeonFromSectorOperation(Request $request)
    {
        $id = $request->id;
        if ($request->id != null) {
            return response()->json([
                'status' => SectorOperationUserModel::find($id)->delete()
            ]);

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
