<?php

namespace App\Http\Controllers\Admin;

use App\Models\offres;
use App\Models\DataOffres;
use App\Models\QualityStatistics;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $technical = offres::where('departements_id',1)->get();
        $techObjectifs = 0;
        $techrealisation = 0;
        $techrate = 0;
        $techrest = 0;
        foreach($technical as $tech)
        {
            $dataoffres = DataOffres::where('offres_id',$tech->id)->get();
            foreach($dataoffres as $data)
            {
                $techrealisation += $data->realisation;
                $techrate += $data->realisation_rate;
                $techrest += $data->rest_per_objectifs;
            }
            $techObjectifs += $tech->objectifs;
        }
        $commercial = offres::where('departements_id',2)->get();
        $comObjectifs = 0;
        $comrealisation = 0;
        $comrate = 0;
        $comrest = 0;
        foreach($commercial as $com)
        {
            $dataoffres = DataOffres::where('offres_id',$com->id)->get();
            foreach($dataoffres as $datacom)
            {
                $comrealisation += $datacom->realisation;
                $comrate += $datacom->realisation_rate;
                $comrest += $datacom->rest_per_objectifs;
            }
            $comObjectifs += $tech->objectifs;
        }
        $fixe = QualityStatistics::where('type','Fixe')->get();
        $fixesdgt_raise = 0;
        $fixesdgt_raised_actual = 0;
        $fixesSuccession_rate = 0;
        $fixesSuccession_rate_24h = 0;
        $fixesSuccession_rate_48h = 0;
        $fixesSuccession_rate_72h = 0;
        $fixesH48_drg_speed = 0;
        foreach($fixe as $fix)
        {
            $fixesdgt_raise = $fix->esdgt_raise;
            $fixesdgt_raised_actual = $fix->dgt_raised_actual;
            $fixesSuccession_rate = $fix->Succession_rate;
            $fixesSuccession_rate_24h = $fix->Succession_rate_24h;
            $fixesSuccession_rate_48h = $fix->Succession_rate_48h;
            $fixesSuccession_rate_72h = $fix->Succession_rate_72h;
            $fixesH48_drg_speed = $fix->H48_drg_speed;
        }
        $adsl = QualityStatistics::where('type','ADSL')->get();
        $adsldgt_raise = 0;
        $adsldgt_raised_actual = 0; 
        $adslSuccession_rate = 0;
        $adslSuccession_rate_24h = 0;
        $adslSuccession_rate_48h = 0;
        $adslSuccession_rate_72h = 0;
        $adslH48_drg_speed = 0;
        $adslmttr_adsl = 0;
        foreach($adsl as $dsl)
        {
            $adsldgt_raise += $dsl->dgt_raise ;
            $adsldgt_raised_actual += $dsl->dgt_raised_actual; 
            $adslSuccession_rate += $dsl->Succession_rate;
            $adslSuccession_rate_24h += $dsl->Succession_rate_24h;
            $adslSuccession_rate_48h += $dsl->Succession_rate_48h;
            $adslSuccession_rate_72h += $dsl->Succession_rate_72h;
            $adslH48_drg_speed += $dsl->H48_drg_speed;
            $adslmttr_adsl += $dsl->mttr_adsl;
        }
        return view('admin.dashboard.index',compact(
            'techObjectifs',
            'techrealisation',
            'techrate',
            'techrest',
            'comObjectifs',
            'comrealisation',
            'comrate',
            'comrest',
            'fixesdgt_raise',
            'fixesdgt_raised_actual',
            'fixesSuccession_rate',
            'fixesSuccession_rate_24h',
            'fixesSuccession_rate_48h',
            'fixesSuccession_rate_72h',
            'fixesH48_drg_speed',
            'adsldgt_raise' ,
            'adsldgt_raised_actual',
            'adslSuccession_rate',
            'adslSuccession_rate_24h',
            'adslSuccession_rate_48h',
            'adslSuccession_rate_72h',
            'adslH48_drg_speed',
            'adslmttr_adsl',
        ));
    }
}
