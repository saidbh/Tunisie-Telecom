<?php

namespace App\Http\Controllers\Admin\Deptech;

use Illuminate\Routing\Controller;
use App\Models\offres;
use App\Models\DataOffres;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class OverviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offre = offres::where('departements_id',1)->get();
        return view('admin.deptech.overview.index', compact('offre'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * get data with ajax request.
     *
     * Ajax request
     * @return JSON response
     */
    public function getStaticsObjectifs(Request $request)
    {
        try {
            $request->ajax();
            $data = DataOffres::where('offres_id',$request->offre)->get();
            return response()->json(['data' => $data], 200); 
        } catch (QueryException $e) {
            return response()->json(['error' => $e], 500);
        }
    }
}
