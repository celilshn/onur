<?php

namespace App\Http\Controllers;

use App\Models\SectorModel;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SectorModel::all();
        return view('main.sector', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function addSector(Request $request)
    {
        if ($request->name != null)
        {
            SectorModel::create(
                [
                    "name"=>$request->name
                ]
            );
            return back();
        }
    }
    public function deleteSector(Request $request)
    {

        if ($request->id != null) {

            return response()->json([
                'status' => SectorModel::find($request->id)->delete()
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
