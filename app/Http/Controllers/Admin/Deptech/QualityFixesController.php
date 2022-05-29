<?php

namespace App\Http\Controllers\Admin\Deptech;

use App\Models\QualityStatistics;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class QualityFixesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fixes = QualityStatistics::where('type','Fixe')->get();
        return view('admin.quality.fixes.index',compact('fixes'));
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
        $validator = Validator::make($request->all(), [
            'files'=> 'bail|required',
            'start_date'=> 'bail|required',
            'end_date'=> 'bail|required',
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }
        try
        {
            $inputFileName = $request->file('files');
            $inputFileType = IOFactory::identify($inputFileName);
            $reader = IOFactory::createReader($inputFileType);
            $spreadsheet = $reader->load($inputFileName);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            $fixes = new QualityStatistics();
            $fixes->departements_id = 1;
            $fixes->type = 'Fixe';
            $fixes->start_date = $request->start_date;
            $fixes->end_date = $request->end_date;
            $fixes->zone = $spreadsheet->getSheet(4)->getCell('B7')->getValue();
            $fixes->dgt_raise = $spreadsheet->getSheet(4)->getCell('AI13')->getValue();
            $fixes->dgt_raised_actual = $spreadsheet->getSheet(4)->getCell('AJ13')->getValue();
            $fixes->Succession_rate = number_format($spreadsheet->getSheet(4)->getCell('AK13')->getValue()*100,2,".",".");
            $fixes->Succession_rate_24h = number_format($spreadsheet->getSheet(4)->getCell('AL13')->getValue()*100,2,".",".");
            $fixes->Succession_rate_48h = number_format($spreadsheet->getSheet(4)->getCell('AM13')->getValue()*100,2,".",".");
            $fixes->Succession_rate_72h = number_format($spreadsheet->getSheet(4)->getCell('AN13')->getValue()*100,2,".",".");
            $fixes->H48_drg_speed = number_format($spreadsheet->getSheet(4)->getCell('AO13')->getValue()*100,2,".",".");
            $fixes->save();
        } catch (QueryException $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
        Session::flash('success', 'Fichiers traité avec succés');
        return redirect()->route('fixes-list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
