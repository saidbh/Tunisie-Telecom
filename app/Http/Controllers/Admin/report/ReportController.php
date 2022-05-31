<?php

namespace App\Http\Controllers\Admin\report;

use App\Models\offres;
use App\Models\departements;
use App\Models\ObjectifTypes;
use App\Models\OffreCommercial;
use App\Models\OffreType;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\HttpFoundation\StreamedResponse;
use PhpOffice\PhpSpreadsheet\Writer as Writer;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offrelist = offres::all();
        $dates = offres::get()->groupBy('objectif_date');
        $types = ObjectifTypes::all();
        return view('admin.report.index',compact('offrelist','dates','types'));
    }
    public function getOutputFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reportExcel'=> 'bail|required',
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }
        try
        {
            $data = [];
            $data = explode(',', $request->reportExcel);
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A2',' ')->getColumnDimension('A')->setWidth(30);
            $sheet->setCellValue('C1', 'Objectif')->getColumnDimension('C')->setWidth(20);
            $sheet->setCellValue('D1', 'Réalisation')->getColumnDimension('D')->setWidth(20);
            $sheet->setCellValue('E1', 'Tx Réal.')->getColumnDimension('E')->setWidth(20);
            $sheet->setCellValue('F1', 'Reste/Objectif')->getColumnDimension('F')->setWidth(20);
            $ComArray = array();
            $techArray = array();
            $listOffresCom = offres::whereIn('id',$data)->where('departements_id',2)->get();
            foreach($listOffresCom as $com)
            {
                array_push($ComArray,$com->CommercialOffre->name);
            }
            $listOffrestech = offres::whereIn('id',$data)->where('departements_id',1)->get();
            foreach($listOffrestech as $com)
            {
                array_push($techArray,$com->OffreType->name);
            }
            $i = 2;
            $j = 2;
            foreach(array_unique($ComArray) as $commercial)
            {
                $sheet->setCellValue('A'.$i, $commercial)->getColumnDimension('A')->setWidth(20);
                $idoffre = OffreCommercial::where('name',$commercial)->first();
                $offre = offres::where('offre_commercial_id',$idoffre->id)->get();
                if(count($offre)== 2)
                {
                    $objectiftype = array();
                    $objective = array();
                    $realisation = array();
                    $rate = array();
                    $rest = array();
                    foreach($offre as $off)
                    {
                        array_push($objectiftype,$off->ObjectifType->name);
                        array_push($objective,$off->objectifs);
                        array_push($realisation,$off->DataOffre?$off->DataOffre->realisation:0);
                        array_push($rate,$off->DataOffre?$off->DataOffre->realisation_rate:0);
                        array_push($rest,$off->DataOffre?$off->DataOffre->rest_per_objectifs:0);
                    }
                    $sheet->setCellValue('B'.$i, $objectiftype[0])->getColumnDimension('B')->setWidth(20);
                    $sheet->setCellValue('B'.$i+1, $objectiftype[0])->getColumnDimension('B')->setWidth(20);
                    $sheet->setCellValue('B'.$i+2, 'Total')->getColumnDimension('B')->setWidth(20);
                    $sheet->setCellValue('C'.$i, $objective[0])->getColumnDimension('C')->setWidth(20);
                    $sheet->setCellValue('C'.$i+1, $objective[1])->getColumnDimension('C')->setWidth(20);
                    $sheet->setCellValue('C'.$i+2, $objective[0]+$objective[1])->getColumnDimension('C')->setWidth(20);
                    $sheet->setCellValue('D'.$i, $realisation[0])->getColumnDimension('D')->setWidth(20);
                    $sheet->setCellValue('D'.$i+1, $realisation[1])->getColumnDimension('D')->setWidth(20);
                    $sheet->setCellValue('D'.$i+2, $realisation[0]+$realisation[1])->getColumnDimension('D')->setWidth(20);
                    $sheet->setCellValue('E'.$i, $rate[0])->getColumnDimension('E')->setWidth(20);
                    $sheet->setCellValue('E'.$i+1, $rate[1])->getColumnDimension('E')->setWidth(20);
                    $sheet->setCellValue('E'.$i+2, $rate[0]+$rate[1])->getColumnDimension('E')->setWidth(20);
                    $sheet->setCellValue('F'.$i, $rest[0])->getColumnDimension('F')->setWidth(20);
                    $sheet->setCellValue('F'.$i+1, $rest[1])->getColumnDimension('F')->setWidth(20);
                    $sheet->setCellValue('F'.$i+2, $rest[0]+$rest[1])->getColumnDimension('F')->setWidth(20);
                }elseif(count($offre)== 1)
                {
                    $objectiftype = array();
                    $objective = array();
                    $realisation = array();
                    $rate = array();
                    $rest = array();
                    foreach($offre as $off)
                    {
                        array_push($objectiftype,$off->ObjectifType->name);
                        array_push($objective,$off->objectifs);
                        array_push($realisation,$off->DataOffre?$off->DataOffre->realisation:0);
                        array_push($rate,$off->DataOffre?$off->DataOffre->realisation_rate:0);
                        array_push($rest,$off->DataOffre?$off->DataOffre->rest_per_objectifs:0);
                    }
                    $sheet->setCellValue('B'.$i, $objectiftype[0])->getColumnDimension('B')->setWidth(20);
                    $sheet->setCellValue('B'.$i+1, '')->getColumnDimension('B')->setWidth(20);
                    $sheet->setCellValue('B'.$i+2, 'Total')->getColumnDimension('B')->setWidth(20);
                    $sheet->setCellValue('C'.$i, $objective[0])->getColumnDimension('C')->setWidth(20);
                    $sheet->setCellValue('C'.$i+1, '')->getColumnDimension('C')->setWidth(20);
                    $sheet->setCellValue('C'.$i+2, $objective[0])->getColumnDimension('C')->setWidth(20);
                    $sheet->setCellValue('D'.$i, $realisation[0])->getColumnDimension('D')->setWidth(20);
                    $sheet->setCellValue('D'.$i+1, '')->getColumnDimension('D')->setWidth(20);
                    $sheet->setCellValue('D'.$i+2, $realisation[0])->getColumnDimension('D')->setWidth(20);
                    $sheet->setCellValue('E'.$i, $rate[0])->getColumnDimension('E')->setWidth(20);
                    $sheet->setCellValue('E'.$i+1, '')->getColumnDimension('E')->setWidth(20);
                    $sheet->setCellValue('E'.$i+2, $rate[0])->getColumnDimension('E')->setWidth(20);
                    $sheet->setCellValue('F'.$i, $rest[0])->getColumnDimension('F')->setWidth(20);
                    $sheet->setCellValue('F'.$i+1, '')->getColumnDimension('F')->setWidth(20);
                    $sheet->setCellValue('F'.$i+2, $rest[0])->getColumnDimension('F')->setWidth(20);
                }
                $i+=3;
            }

            foreach(array_unique($techArray) as $tech)
            {
                $sheet->setCellValue('A'.$i, $tech)->getColumnDimension('A')->setWidth(20);
                $idoffre = OffreType::where('name',$tech)->first();
                $offre = offres::where('offre_type_id',$idoffre->id)->get();
                if(count($offre)== 2)
                {
                    $objectiftype = array();
                    $objective = array();
                    $realisation = array();
                    $rate = array();
                    $rest = array();
                    foreach($offre as $off)
                    {
                        array_push($objectiftype,$off->ObjectifType->name);
                        array_push($objective,$off->objectifs);
                        array_push($realisation,$off->DataOffre?$off->DataOffre->realisation:0);
                        array_push($rate,$off->DataOffre?$off->DataOffre->realisation_rate:0);
                        array_push($rest,$off->DataOffre?$off->DataOffre->rest_per_objectifs:0);
                    }
                    $sheet->setCellValue('B'.$i, $objectiftype[0])->getColumnDimension('B')->setWidth(20);
                    $sheet->setCellValue('B'.$i+1, $objectiftype[0])->getColumnDimension('B')->setWidth(20);
                    $sheet->setCellValue('B'.$i+2, 'Total')->getColumnDimension('B')->setWidth(20);
                    $sheet->setCellValue('C'.$i, $objective[0])->getColumnDimension('C')->setWidth(20);
                    $sheet->setCellValue('C'.$i+1, $objective[1])->getColumnDimension('C')->setWidth(20);
                    $sheet->setCellValue('C'.$i+2, $objective[0]+$objective[1])->getColumnDimension('C')->setWidth(20);
                    $sheet->setCellValue('D'.$i, $realisation[0])->getColumnDimension('D')->setWidth(20);
                    $sheet->setCellValue('D'.$i+1, $realisation[1])->getColumnDimension('D')->setWidth(20);
                    $sheet->setCellValue('D'.$i+2, $realisation[0]+$realisation[1])->getColumnDimension('D')->setWidth(20);
                    $sheet->setCellValue('E'.$i, $rate[0])->getColumnDimension('E')->setWidth(20);
                    $sheet->setCellValue('E'.$i+1, $rate[1])->getColumnDimension('E')->setWidth(20);
                    $sheet->setCellValue('E'.$i+2, $rate[0]+$rate[1])->getColumnDimension('E')->setWidth(20);
                    $sheet->setCellValue('F'.$i, $rest[0])->getColumnDimension('F')->setWidth(20);
                    $sheet->setCellValue('F'.$i+1, $rest[1])->getColumnDimension('F')->setWidth(20);
                    $sheet->setCellValue('F'.$i+2, $rest[0]+$rest[1])->getColumnDimension('F')->setWidth(20);
                }elseif(count($offre)== 1)
                {
                    $objectiftype = array();
                    $objective = array();
                    $realisation = array();
                    $rate = array();
                    $rest = array();
                    foreach($offre as $off)
                    {
                        array_push($objectiftype,$off->ObjectifType->name);
                        array_push($objective,$off->objectifs);
                        array_push($realisation,$off->DataOffre?$off->DataOffre->realisation:0);
                        array_push($rate,$off->DataOffre?$off->DataOffre->realisation_rate:0);
                        array_push($rest,$off->DataOffre?$off->DataOffre->rest_per_objectifs:0);
                    }
                    $sheet->setCellValue('B'.$i, $objectiftype[0])->getColumnDimension('B')->setWidth(20);
                    $sheet->setCellValue('B'.$i+1, '')->getColumnDimension('B')->setWidth(20);
                    $sheet->setCellValue('B'.$i+2, 'Total')->getColumnDimension('B')->setWidth(20);
                    $sheet->setCellValue('C'.$i, $objective[0])->getColumnDimension('C')->setWidth(20);
                    $sheet->setCellValue('C'.$i+1, '')->getColumnDimension('C')->setWidth(20);
                    $sheet->setCellValue('C'.$i+2, $objective[0])->getColumnDimension('C')->setWidth(20);
                    $sheet->setCellValue('D'.$i, $realisation[0])->getColumnDimension('D')->setWidth(20);
                    $sheet->setCellValue('D'.$i+1, '')->getColumnDimension('D')->setWidth(20);
                    $sheet->setCellValue('D'.$i+2, $realisation[0])->getColumnDimension('D')->setWidth(20);
                    $sheet->setCellValue('E'.$i, $rate[0])->getColumnDimension('E')->setWidth(20);
                    $sheet->setCellValue('E'.$i+1, '')->getColumnDimension('E')->setWidth(20);
                    $sheet->setCellValue('E'.$i+2, $rate[0])->getColumnDimension('E')->setWidth(20);
                    $sheet->setCellValue('F'.$i, $rest[0])->getColumnDimension('F')->setWidth(20);
                    $sheet->setCellValue('F'.$i+1, '')->getColumnDimension('F')->setWidth(20);
                    $sheet->setCellValue('F'.$i+2, $rest[0])->getColumnDimension('F')->setWidth(20);
                }
                $i+=3;
            }
            $response = response()->streamDownload(function() use ($spreadsheet) {
                $writer = new Xlsx($spreadsheet);
                $writer->save('php://output');
                });
                $response->setStatusCode(200);
                $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                $response->headers->set('Content-Disposition', 'attachment; filename="Rapport journalier.xls"');
                $response->send();
        }catch(QueryException $e)
        {
            Session::flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

}
