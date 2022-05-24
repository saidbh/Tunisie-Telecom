<?php

namespace App\Http\Controllers\Admin\depcom;

use App\Models\DataOffres;
use App\Models\offres;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class RealisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'offres_id'=> 'bail|required',
            'date'=> 'bail|required',
            'objectifs'=> 'bail|required',
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }
        try {
            $inputFileName = $request->file('files');
            $inputFileType = IOFactory::identify($inputFileName);
            $reader = IOFactory::createReader($inputFileType);
            $spreadsheet = $reader->load($inputFileName);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

            switch($request->offres_id)
            {
                case(1):
                    for ($i = 'a'; $i < 'zz'; $i++)
                    {
                        $cell = $spreadsheet->getActiveSheet()->getCell($i.'4')->getValue();
                        if ($cell == 'Total')
                        {
                            $Privilege = $spreadsheet->getActiveSheet()->getCell($i.'28')->getValue();
                            $CorporateOptimumPlus = $spreadsheet->getActiveSheet()->getCell($i.'6')->getValue();
                            $ForfaitSELECT = $spreadsheet->getActiveSheet()->getCell($i.'10')->getValue();
                            $OhMega = $spreadsheet->getActiveSheet()->getCell($i.'17')->getValue();
                            $Dimaconnecthyb = $spreadsheet->getActiveSheet()->getCell($i.'9')->getValue();
                            $OPTICA = $spreadsheet->getActiveSheet()->getCell($i.'18')->getValue();
                            $Sigoundapostpaye = $spreadsheet->getActiveSheet()->getCell($i.'29')->getValue();
                            $MFRealisation = $Privilege + $CorporateOptimumPlus + $ForfaitSELECT + $OhMega + $Dimaconnecthyb + $OPTICA + $Sigoundapostpaye;
                            $rate = $MFRealisation / $request->objectifs * 100;
                            $rest = $request->objectifs - $MFRealisation;
                            $data = new DataOffres();
                            $data->offres_id = $request->offres_id;
                            $data->realisation_date = $request->date;
                            $data->realisation = $MFRealisation;
                            $data->realisation_rate = $rate;
                            $data->rest_per_objectifs = $rest;
                            $data->save();
                            break;
                        }
                    }
                    break;
                case(2):
                    for ($i = 'a'; $i < 'zz'; $i++)
                    {
                        $cell = $spreadsheet->getActiveSheet()->getCell($i.'4')->getValue();
                        if ($cell == 'Total')
                        {
                            $cell1 = $spreadsheet->getActiveSheet()->getCell($i.'11')->getValue();
                            $cell2 = $spreadsheet->getActiveSheet()->getCell($i.'20')->getValue();
                            $cell3 = $spreadsheet->getActiveSheet()->getCell($i.'21')->getValue();
                            $cell4 = $spreadsheet->getActiveSheet()->getCell($i.'22')->getValue();
                            $cell5 = $spreadsheet->getActiveSheet()->getCell($i.'23')->getValue();
                            $cell6 = $spreadsheet->getActiveSheet()->getCell($i.'24')->getValue();
                            $cell7 = $spreadsheet->getActiveSheet()->getCell($i.'25')->getValue();
                            $cell8 = $spreadsheet->getActiveSheet()->getCell($i.'26')->getValue();
                            $cell9 = $spreadsheet->getActiveSheet()->getCell($i.'27')->getValue();
                            $MPBRealisation = $cell1+ $cell2 +$cell3 + $cell4 + $cell5 + $cell6 + $cell7 + $cell8 + $cell9;
                            $rate = $MPBRealisation / $request->objectifs * 100;
                            $rest = $request->objectifs - $MPBRealisation;
                            $data1 = new DataOffres();
                            $data1->offres_id = $request->offres_id;
                            $data1->realisation_date = $request->date;
                            $data1->realisation = $MPBRealisation;
                            $data1->realisation_rate = $rate;
                            $data1->rest_per_objectifs = $rest;
                            $data1->save();
                            break;
                        }
                    }
                    break;
                case(3):
                    for ($i = 'a'; $i < 'zz'; $i++)
                    {
                        $cell = $spreadsheet->getActiveSheet()->getCell($i.'4')->getValue();
                        if ($cell == 'Total')
                        {
                            $Privilege = $spreadsheet->getActiveSheet()->getCell($i.'28')->getValue();
                            $CorporateOptimumPlus = $spreadsheet->getActiveSheet()->getCell($i.'6')->getValue();
                            $ForfaitSELECT = $spreadsheet->getActiveSheet()->getCell($i.'10')->getValue();
                            $OhMega = $spreadsheet->getActiveSheet()->getCell($i.'17')->getValue();
                            $Dimaconnecthyb = $spreadsheet->getActiveSheet()->getCell($i.'9')->getValue();
                            $OPTICA = $spreadsheet->getActiveSheet()->getCell($i.'18')->getValue();
                            $Sigoundapostpaye = $spreadsheet->getActiveSheet()->getCell($i.'29')->getValue();
                            $MFRealisation = $Privilege + $CorporateOptimumPlus + $ForfaitSELECT + $OhMega + $Dimaconnecthyb + $OPTICA + $Sigoundapostpaye;
                            $rate = $MFRealisation / $request->objectifs * 100;
                            $rest = $request->objectifs - $MFRealisation;
                            $data2 = new DataOffres();
                            $data2->offres_id = $request->offres_id;
                            $data2->realisation_date = $request->date;
                            $data2->realisation = $MFRealisation;
                            $data2->realisation_rate = $rate;
                            $data2->rest_per_objectifs = $rest;
                            $data2->save();
                            break;
                        }
                    }
                    break;
                case(4):
                    for ($i = 'a'; $i < 'zz'; $i++)
                    {
                        $cell = $spreadsheet->getActiveSheet()->getCell($i.'4')->getValue();
                        if ($cell == 'Total')
                        {
                            $Privilege = $spreadsheet->getActiveSheet()->getCell($i.'28')->getValue();
                            $CorporateOptimumPlus = $spreadsheet->getActiveSheet()->getCell($i.'6')->getValue();
                            $ForfaitSELECT = $spreadsheet->getActiveSheet()->getCell($i.'10')->getValue();
                            $OhMega = $spreadsheet->getActiveSheet()->getCell($i.'17')->getValue();
                            $Dimaconnecthyb = $spreadsheet->getActiveSheet()->getCell($i.'9')->getValue();
                            $OPTICA = $spreadsheet->getActiveSheet()->getCell($i.'18')->getValue();
                            $Sigoundapostpaye = $spreadsheet->getActiveSheet()->getCell($i.'29')->getValue();
                            $MFRealisation = $Privilege + $CorporateOptimumPlus + $ForfaitSELECT + $OhMega + $Dimaconnecthyb + $OPTICA + $Sigoundapostpaye;
                            $rate = $MFRealisation / $request->objectifs * 100;
                            $rest = $request->objectifs - $MFRealisation;
                            $data = new DataOffres();
                            $data->offres_id = $request->offres_id;
                            $data->realisation_date = $request->date;
                            $data->realisation = $MFRealisation;
                            $data->realisation_rate = $rate;
                            $data->rest_per_objectifs = $rest;
                            $data->save();
                            break;
                        }
                    }
                    break;
                case(5):
                    for ($i = 'a'; $i < 'zz'; $i++)
                    {
                        $cell = $spreadsheet->getActiveSheet()->getCell($i.'4')->getValue();
                        if ($cell == 'Total')
                        {
                            $Privilege = $spreadsheet->getActiveSheet()->getCell($i.'28')->getValue();
                            $CorporateOptimumPlus = $spreadsheet->getActiveSheet()->getCell($i.'6')->getValue();
                            $ForfaitSELECT = $spreadsheet->getActiveSheet()->getCell($i.'10')->getValue();
                            $OhMega = $spreadsheet->getActiveSheet()->getCell($i.'17')->getValue();
                            $Dimaconnecthyb = $spreadsheet->getActiveSheet()->getCell($i.'9')->getValue();
                            $OPTICA = $spreadsheet->getActiveSheet()->getCell($i.'18')->getValue();
                            $Sigoundapostpaye = $spreadsheet->getActiveSheet()->getCell($i.'29')->getValue();
                            $MFRealisation = $Privilege + $CorporateOptimumPlus + $ForfaitSELECT + $OhMega + $Dimaconnecthyb + $OPTICA + $Sigoundapostpaye;
                            $rate = $MFRealisation / $request->objectifs * 100;
                            $rest = $request->objectifs - $MFRealisation;
                            $data = new DataOffres();
                            $data->offres_id = $request->offres_id;
                            $data->realisation_date = $request->date;
                            $data->realisation = $MFRealisation;
                            $data->realisation_rate = $rate;
                            $data->rest_per_objectifs = $rest;
                            $data->save();
                            break;
                        }
                    }
                    break;
                case(6):
                    for ($i = 'a'; $i < 'zz'; $i++)
                    {
                        $cell = $spreadsheet->getActiveSheet()->getCell($i.'4')->getValue();
                        if ($cell == 'Total')
                        {
                            $Privilege = $spreadsheet->getActiveSheet()->getCell($i.'28')->getValue();
                            $CorporateOptimumPlus = $spreadsheet->getActiveSheet()->getCell($i.'6')->getValue();
                            $ForfaitSELECT = $spreadsheet->getActiveSheet()->getCell($i.'10')->getValue();
                            $OhMega = $spreadsheet->getActiveSheet()->getCell($i.'17')->getValue();
                            $Dimaconnecthyb = $spreadsheet->getActiveSheet()->getCell($i.'9')->getValue();
                            $OPTICA = $spreadsheet->getActiveSheet()->getCell($i.'18')->getValue();
                            $Sigoundapostpaye = $spreadsheet->getActiveSheet()->getCell($i.'29')->getValue();
                            $MFRealisation = $Privilege + $CorporateOptimumPlus + $ForfaitSELECT + $OhMega + $Dimaconnecthyb + $OPTICA + $Sigoundapostpaye;
                            $rate = $MFRealisation / $request->objectifs * 100;
                            $rest = $request->objectifs - $MFRealisation;
                            $data = new DataOffres();
                            $data->offres_id = $request->offres_id;
                            $data->realisation_date = $request->date;
                            $data->realisation = $MFRealisation;
                            $data->realisation_rate = $rate;
                            $data->rest_per_objectifs = $rest;
                            $data->save();
                            break;
                        }
                    }
                    break;
                case(7):
                    for ($i = 'a'; $i < 'zz'; $i++)
                    {
                        $cell = $spreadsheet->getActiveSheet()->getCell($i.'4')->getValue();
                        if ($cell == 'Total')
                        {
                            $Privilege = $spreadsheet->getActiveSheet()->getCell($i.'28')->getValue();
                            $CorporateOptimumPlus = $spreadsheet->getActiveSheet()->getCell($i.'6')->getValue();
                            $ForfaitSELECT = $spreadsheet->getActiveSheet()->getCell($i.'10')->getValue();
                            $OhMega = $spreadsheet->getActiveSheet()->getCell($i.'17')->getValue();
                            $Dimaconnecthyb = $spreadsheet->getActiveSheet()->getCell($i.'9')->getValue();
                            $OPTICA = $spreadsheet->getActiveSheet()->getCell($i.'18')->getValue();
                            $Sigoundapostpaye = $spreadsheet->getActiveSheet()->getCell($i.'29')->getValue();
                            $MFRealisation = $Privilege + $CorporateOptimumPlus + $ForfaitSELECT + $OhMega + $Dimaconnecthyb + $OPTICA + $Sigoundapostpaye;
                            $rate = $MFRealisation / $request->objectifs * 100;
                            $rest = $request->objectifs - $MFRealisation;
                            $data = new DataOffres();
                            $data->offres_id = $request->offres_id;
                            $data->realisation_date = $request->date;
                            $data->realisation = $MFRealisation;
                            $data->realisation_rate = $rate;
                            $data->rest_per_objectifs = $rest;
                            $data->save();
                            break;
                        }
                    }
                    break;
                case(8):
                    for ($i = 'a'; $i < 'zz'; $i++)
                    {
                        $cell = $spreadsheet->getActiveSheet()->getCell($i.'4')->getValue();
                        if ($cell == 'Total')
                        {
                            $Privilege = $spreadsheet->getActiveSheet()->getCell($i.'28')->getValue();
                            $CorporateOptimumPlus = $spreadsheet->getActiveSheet()->getCell($i.'6')->getValue();
                            $ForfaitSELECT = $spreadsheet->getActiveSheet()->getCell($i.'10')->getValue();
                            $OhMega = $spreadsheet->getActiveSheet()->getCell($i.'17')->getValue();
                            $Dimaconnecthyb = $spreadsheet->getActiveSheet()->getCell($i.'9')->getValue();
                            $OPTICA = $spreadsheet->getActiveSheet()->getCell($i.'18')->getValue();
                            $Sigoundapostpaye = $spreadsheet->getActiveSheet()->getCell($i.'29')->getValue();
                            $MFRealisation = $Privilege + $CorporateOptimumPlus + $ForfaitSELECT + $OhMega + $Dimaconnecthyb + $OPTICA + $Sigoundapostpaye;
                            $rate = $MFRealisation / $request->objectifs * 100;
                            $rest = $request->objectifs - $MFRealisation;
                            $data = new DataOffres();
                            $data->offres_id = $request->offres_id;
                            $data->realisation_date = $request->date;
                            $data->realisation = $MFRealisation;
                            $data->realisation_rate = $rate;
                            $data->rest_per_objectifs = $rest;
                            $data->save();
                            break;
                        }
                    }
                    break;
                case(9):
                    for ($i = 'a'; $i < 'zz'; $i++)
                    {
                        $cell = $spreadsheet->getActiveSheet()->getCell($i.'4')->getValue();
                        if ($cell == 'Total')
                        {
                            $Privilege = $spreadsheet->getActiveSheet()->getCell($i.'28')->getValue();
                            $CorporateOptimumPlus = $spreadsheet->getActiveSheet()->getCell($i.'6')->getValue();
                            $ForfaitSELECT = $spreadsheet->getActiveSheet()->getCell($i.'10')->getValue();
                            $OhMega = $spreadsheet->getActiveSheet()->getCell($i.'17')->getValue();
                            $Dimaconnecthyb = $spreadsheet->getActiveSheet()->getCell($i.'9')->getValue();
                            $OPTICA = $spreadsheet->getActiveSheet()->getCell($i.'18')->getValue();
                            $Sigoundapostpaye = $spreadsheet->getActiveSheet()->getCell($i.'29')->getValue();
                            $MFRealisation = $Privilege + $CorporateOptimumPlus + $ForfaitSELECT + $OhMega + $Dimaconnecthyb + $OPTICA + $Sigoundapostpaye;
                            $rate = $MFRealisation / $request->objectifs * 100;
                            $rest = $request->objectifs - $MFRealisation;
                            $data = new DataOffres();
                            $data->offres_id = $request->offres_id;
                            $data->realisation_date = $request->date;
                            $data->realisation = $MFRealisation;
                            $data->realisation_rate = $rate;
                            $data->rest_per_objectifs = $rest;
                            $data->save();
                            break;
                        }
                    }
                    break;
                case(10):
                    for ($i = 'a'; $i < 'zz'; $i++)
                    {
                        $cell = $spreadsheet->getActiveSheet()->getCell($i.'4')->getValue();
                        if ($cell == 'Total')
                        {
                            $Privilege = $spreadsheet->getActiveSheet()->getCell($i.'28')->getValue();
                            $CorporateOptimumPlus = $spreadsheet->getActiveSheet()->getCell($i.'6')->getValue();
                            $ForfaitSELECT = $spreadsheet->getActiveSheet()->getCell($i.'10')->getValue();
                            $OhMega = $spreadsheet->getActiveSheet()->getCell($i.'17')->getValue();
                            $Dimaconnecthyb = $spreadsheet->getActiveSheet()->getCell($i.'9')->getValue();
                            $OPTICA = $spreadsheet->getActiveSheet()->getCell($i.'18')->getValue();
                            $Sigoundapostpaye = $spreadsheet->getActiveSheet()->getCell($i.'29')->getValue();
                            $MFRealisation = $Privilege + $CorporateOptimumPlus + $ForfaitSELECT + $OhMega + $Dimaconnecthyb + $OPTICA + $Sigoundapostpaye;
                            $rate = $MFRealisation / $request->objectifs * 100;
                            $rest = $request->objectifs - $MFRealisation;
                            $data = new DataOffres();
                            $data->offres_id = $request->offres_id;
                            $data->realisation_date = $request->date;
                            $data->realisation = $MFRealisation;
                            $data->realisation_rate = $rate;
                            $data->rest_per_objectifs = $rest;
                            $data->save();
                            break;
                        }
                    }
                    break;
                case(11):
                    for ($i = 'a'; $i < 'zz'; $i++)
                    {
                        $cell = $spreadsheet->getActiveSheet()->getCell($i.'4')->getValue();
                        if ($cell == 'Total')
                        {
                            $Privilege = $spreadsheet->getActiveSheet()->getCell($i.'28')->getValue();
                            $CorporateOptimumPlus = $spreadsheet->getActiveSheet()->getCell($i.'6')->getValue();
                            $ForfaitSELECT = $spreadsheet->getActiveSheet()->getCell($i.'10')->getValue();
                            $OhMega = $spreadsheet->getActiveSheet()->getCell($i.'17')->getValue();
                            $Dimaconnecthyb = $spreadsheet->getActiveSheet()->getCell($i.'9')->getValue();
                            $OPTICA = $spreadsheet->getActiveSheet()->getCell($i.'18')->getValue();
                            $Sigoundapostpaye = $spreadsheet->getActiveSheet()->getCell($i.'29')->getValue();
                            $MFRealisation = $Privilege + $CorporateOptimumPlus + $ForfaitSELECT + $OhMega + $Dimaconnecthyb + $OPTICA + $Sigoundapostpaye;
                            $rate = $MFRealisation / $request->objectifs * 100;
                            $rest = $request->objectifs - $MFRealisation;
                            $data = new DataOffres();
                            $data->offres_id = $request->offres_id;
                            $data->realisation_date = $request->date;
                            $data->realisation = $MFRealisation;
                            $data->realisation_rate = $rate;
                            $data->rest_per_objectifs = $rest;
                            $data->save();
                            break;
                        }
                    }
                    break;
            }

        } catch (QueryException $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
        Session::flash('success', 'Realisation ajouter pour cet offre avec succés');
        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $offre = offres::where('id',$id)->first();
        $realisations = DataOffres::where('offres_id',$id)->get();
        return view('admin.depcom.offres.realisations',compact('offre','realisations'));
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
