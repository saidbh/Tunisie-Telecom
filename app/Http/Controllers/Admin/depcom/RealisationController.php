<?php

namespace App\Http\Controllers\Admin\depcom;

use App\Models\DataOffres;
use App\Models\OffreCommercial;
use App\Models\SubOffreCommercial;
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
            'type' => 'bail|required',
            'offresCom_id' => 'bail|required'
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
            switch($request->offresCom_id)
            {
                case(1):
                    case(2):
                        case(3):
                            case(4):
                                case(5):
                    for ($i = 'a'; $i < 'zz'; $i++)
                    {
                        $cell = $spreadsheet->getActiveSheet()->getCell($i.'4')->getValue();
                        if ($cell == 'Total')
                        {
                            $subOffres = SubOffreCommercial::where('offre_commercial_id',$request->offres_id)->get();
                            $TotalCell = 0;
                            $limit = 0;
                            $array = [];
                            foreach($subOffres as $sub)
                            {
                                $j = 0;
                                $row = 5;
                                do {
                                    if($sub->name == $spreadsheet->getActiveSheet()->getCell('C'.$row)->getValue())
                                    {
                                        array_push($array,$spreadsheet->getActiveSheet()->getCell('C'.$row)->getValue());
                                        $TotalCell += $spreadsheet->getActiveSheet()->getCell($i.$row)->getValue();
                                        $j++;
                                        $row++;
                                        $limit++;
                                    }else
                                    {
                                        $j++;
                                        $row++;
                                    }
                                    if($limit == count($subOffres) - 1)
                                    {
                                        break;
                                    }
                                } while ($j <= 1000);
                            }
                            $rate = $TotalCell / $request->objectifs * 100;
                            $rest = $request->objectifs - $TotalCell;
                            $data = new DataOffres();
                            $data->offres_id = $request->offres_id;
                            $data->realisation_date = $request->date;
                            $data->realisation = $TotalCell;
                            $data->realisation_rate = $rate;
                            $data->rest_per_objectifs = $rest;
                            $data->save();
                            break;
                        }
                    }
                    break;
                case(6):
                case(7):
                case(8):
                    break;
                case(9):
                case(10):
                    for ($i = 'a'; $i < 'zz'; $i++)
                    {
                        $cell = $spreadsheet->getSheet(2)->getCell($i.'5')->getValue();
                        if ($cell == 'Demandes effectuées')
                        {
                            $subOffres = SubOffreCommercial::where('offre_commercial_id',$request->offres_id)->get();
                            $TotalCell = 0;
                            $limit = 0;
                            foreach($subOffres as $sub)
                            {
                                $j = 0;
                                $row = 6;
                                do {
                                    if($sub->name == $spreadsheet->getActiveSheet()->getCell('A'.$row)->getValue())
                                    {
                                        $TotalCell += $spreadsheet->getActiveSheet()->getCell($i.$row)->getValue();
                                        $j++;
                                        $row++;
                                        $limit++;
                                    }else
                                    {
                                        $j++;
                                        $row++;
                                    }
                                    if($limit == count($subOffres) - 1)
                                    {
                                        break;
                                    }
                                } while ($j <= 1000);
                            }
                            $rate = $TotalCell / $request->objectifs * 100;
                            $rest = $request->objectifs - $TotalCell;
                            $data = new DataOffres();
                            $data->offres_id = $request->offres_id;
                            $data->realisation_date = $request->date;
                            $data->realisation = $TotalCell;
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
