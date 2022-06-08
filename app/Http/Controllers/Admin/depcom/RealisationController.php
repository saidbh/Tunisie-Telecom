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
            'offresCom_id' => 'bail|required',
            'sub_offre.*' => 'bail|required'
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }
        try {
            if(!is_array($request->file('files')))
            {
                $inputFileName = $request->file('files');
                $inputFileType = IOFactory::identify($inputFileName);
                $reader = IOFactory::createReader($inputFileType);
                $spreadsheet = $reader->load($inputFileName);
                $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            }
            switch($request->offresCom_id)
            {
                case(1):
                    case(2):
                        case(3):
                            case(4):
                                case(5):
                                    $col = '';
                    for ($i = 'a'; $i < 'zz'; $i++)
                    {
                        $cell = $spreadsheet->getActiveSheet()->getCell($i.'4')->getValue();
                        if ($cell == 'Total')
                        {
                            $col = $i;
                            break;
                        }
                    }
                    $row = 0;
                    for($s=0;$s<=1000;$s++)
                    {
                        if($spreadsheet->getActiveSheet()->getCell('B'.$s)->getValue() == $request->type)
                        {
                            $row = $s;
                        }
                    }
                    $subOffres = SubOffreCommercial::where('offre_commercial_id',$request->offresCom_id)->get();
                    $TotalCell = 0;
                    $limit = 0;
                    $array = [];
                    $limit = 0;
                    $offres = array();
                    foreach($request->sub_offre as $sub)
                    {
                        array_push($offres,$sub);
                    }
                    for($j=0;$j<=200;$j++)
                    {   
                        if(in_array($spreadsheet->getActiveSheet()->getCell('C'.$row)->getValue(), $offres))
                        {
                            array_push($array,$spreadsheet->getActiveSheet()->getCell($col.$row)->getValue());
                            $TotalCell += $spreadsheet->getActiveSheet()->getCell($col.$row)->getValue();
                            $row++;
                            $limit++;
                        }else
                        {
                            $row++;
                        }
                        if(count($request->sub_offre) + 1 <= $limit + 1)
                        {
                            break;
                        } 
                    }
                    $data = new DataOffres();
                    $data->offres_id = $request->offres_id;
                    $data->realisation_date = $request->date;
                    $data->realisation = $TotalCell;
                    if($request->has('last_realisation'))
                    {
                        $lastvalue = DataOffres::where('id',$request->last_realisation)->first();
                        $data->realisation_rate = $lastvalue->realisation_rate + intval($TotalCell / $request->objectifs * 100);
                        if($lastvalue->rest_per_objectifs == 0 || $TotalCell>$lastvalue->rest_per_objectifs)
                        {
                            $data->rest_per_objectifs = 0;
                        }else
                        {
                            $data->rest_per_objectifs = $lastvalue->rest_per_objectifs - $TotalCell;
                        }
                    }else
                    {
                        $data->realisation_rate = intval($TotalCell / $request->objectifs * 100);
                        if($request->objectifs > $TotalCell)
                        {
                            $data->rest_per_objectifs = $request->objectifs - $TotalCell;
                        }else
                        {
                            $data->rest_per_objectifs = 0;
                        }
                    }
                    $data->save(); 
                    break;
                case(6):
                    if($request->type == 'NI+RA')
                    {
                        $TotalCell = $spreadsheet->getSheet(0)->getCell('C116')->getValue();
                    }elseif($request->type == 'Migration')
                    {
                        $TotalCell = $spreadsheet->getSheet(0)->getCell('C118')->getValue();
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
                case(7): 
                    if($request->type == 'NI+RA')
                    {
                        $c1 = $spreadsheet->getSheet(0)->getCell('C32')->getValue();
                        $c3 = $spreadsheet->getSheet(0)->getCell('C44')->getValue();
                        $c5 = $spreadsheet->getSheet(0)->getCell('C56')->getValue();
                        $c7 = $spreadsheet->getSheet(0)->getCell('C68')->getValue();
                        $TotalCell = $c1 + $c3 + $c5 + $c7 ;
                    }elseif($request->type == 'Migration')
                    {
                        $c2 = $spreadsheet->getSheet(0)->getCell('C34')->getValue();
                        $c4 = $spreadsheet->getSheet(0)->getCell('C46')->getValue();
                        $c6 = $spreadsheet->getSheet(0)->getCell('C58')->getValue();
                        $c8 = $spreadsheet->getSheet(0)->getCell('C70')->getValue();
                        $TotalCell = $c2 + $c4 + $c6 + $c8 ;
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
                case(8):
                    $TotalCell1 = 0; 
                    $TotalCell2 = 0;
                    foreach($request->file('files') as $file)
                    {
                        $inputFileType = IOFactory::identify($file);
                        $reader = IOFactory::createReader($inputFileType);
                        $spreadsheet = $reader->load($file);
                        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
                        try
                        {
                            if($request->type == 'NI+RA')
                            {
                                $c1 = $spreadsheet->getSheet(0)->getCell('F32')->getValue();
                                $c3 = $spreadsheet->getSheet(0)->getCell('F44')->getValue();
                                $TotalCell1 += $c1 + $c3;
                            }elseif($request->type == 'Migration')
                            {
                                $c2 = $spreadsheet->getSheet(0)->getCell('F34')->getValue();
                                $c4 = $spreadsheet->getSheet(0)->getCell('F46')->getValue();
                                $TotalCell1 += $c2 + $c4;
                            }
                              
                        }catch(Exception $e)
                        {
                            //
                            Session::flash('error', $e->getMessage(). $TotalCell1.'first file');
                            return redirect()->back()->withInput();
                        }
                        try
                        {
                            if($request->type == 'NI+RA')
                            {
                                $b1 = $spreadsheet->getSheet(0)->getCell('C8')->getValue();
                                $b3 = $spreadsheet->getSheet(0)->getCell('C20')->getValue();
                                $b5 = $spreadsheet->getSheet(0)->getCell('C80')->getValue();
                                $b7 = $spreadsheet->getSheet(0)->getCell('C92')->getValue();
                                $b9 = $spreadsheet->getSheet(0)->getCell('C104')->getValue();
                                $TotalCell2 += $b1 + $b3 + $b5 + $b7 + $b9;
                            }elseif($request->type == 'Migration')
                            {
                                $b2 = $spreadsheet->getSheet(0)->getCell('C10')->getValue();
                                $b4 = $spreadsheet->getSheet(0)->getCell('C22')->getValue();
                                $b6 = $spreadsheet->getSheet(0)->getCell('C82')->getValue();
                                $b8 = $spreadsheet->getSheet(0)->getCell('C94')->getValue();
                                $b10 = $spreadsheet->getSheet(0)->getCell('C106')->getValue();
                                $TotalCell2 +=  $b2 + $b4 + $b6 + $b8 + $b10;
                            }
                            
                        }catch(Exception $e)
                        {
                            //
                            Session::flash('error', $e->getMessage(). $TotalCell1.'second file');
                            return redirect()->back()->withInput();
                        }
                    }
                    if($TotalCell1 !=null || $TotalCell2 != null)
                    {
                        $TotalCell = $TotalCell1 + $TotalCell2;
                        $rate = $TotalCell / $request->objectifs * 100;
                        $rest = $request->objectifs - $TotalCell;
                        $data = new DataOffres();
                        $data->offres_id = $request->offres_id;
                        $data->realisation_date = $request->date;
                        $data->realisation = $TotalCell;
                        $data->realisation_rate = $rate;
                        $data->rest_per_objectifs = $rest;
                        $data->save();
                        Session::flash('success', 'Fichiers traité avec succeé');
                        return redirect()->back()->withInput();
                    }else
                    {
                        Session::flash('error','Erreur fichiers !');
                        return redirect()->back()->withInput();
                    }
                    break;
                case(9):
                case(10):
                     $row = 0;
                    for($i = 'A'; $i < 'ZZ'; $i++)
                    {
                        if($spreadsheet->getSheet(2)->getCell($i.'5')->getValue() == 'Demandes effectuées')
                        {
                            $row = $i;
                        }
                    }
                    $subOffres = SubOffreCommercial::where('offre_commercial_id',$request->offresCom_id)->get();
                    $TotalCell = 0;
                    $array = [];
                    $limit = 0;
                    $col = 5;
                    $offres = array();
                    foreach($request->sub_offre as $sub)
                    {
                        array_push($offres,$sub);
                    }
                    for($j=0;$j<=200;$j++)
                    {   
                        if(in_array($spreadsheet->getSheet(2)->getCell('A'.$col)->getValue(), $offres))
                        {
                            array_push($array,$spreadsheet->getSheet(2)->getCell($row.$col)->getValue());
                            $TotalCell += $spreadsheet->getSheet(2)->getCell($row.$col)->getValue();
                            $col++;
                            $limit++;
                        }else
                        {
                            $col++;
                        }
                        if(count($request->sub_offre) + 1 <= $limit + 1)
                        {
                            break;
                        } 
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
        $suboffres = SubOffreCommercial::where('offre_commercial_id',$offre->offre_commercial_id)->get();
        return view('admin.depcom.offres.realisations',compact('offre','realisations','suboffres'));
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
