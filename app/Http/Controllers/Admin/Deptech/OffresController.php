<?php

namespace App\Http\Controllers\Admin\Deptech;

use App\Models\DataOffres;
use App\Models\ObjectifTypes;
use App\Models\offres;
use App\Models\OffreType;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OffresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offres = OffreType::all();
        $objectiftypes = ObjectifTypes::all();
        $offrelist = offres::where('departements_id',1)->get();
        return view('admin.deptech.offres.index',compact('offres','objectiftypes','offrelist'));
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
            'offre_type'=> 'bail|required',
            'objectif_type'=> 'bail|required',
            'objectif_date'=>'bail|required',
            'objectifs'=>'bail|required',
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }
        try {
            if(
            !offres::where('offre_type_id',$request->offre_type)
            ->where('objectif_types_id',$request->objectif_type)
            ->where('objectif_date',$request->objectif_date)
            ->first()
            )
            {
                $offre = new offres();
                $offre->offre_type_id = $request->offre_type;
                $offre->objectif_types_id = $request->objectif_type;
                $offre->departements_id = 1;
                $offre->documents_id = null;
                $offre->objectif_date = $request->objectif_date;
                $offre->objectifs = $request->objectifs;
                $offre->save();
            }else
            {
                Session::flash('error', 'Offre existe deja !');
                return redirect()->route('technical-offres-list');
            }
        } catch (QueryException $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
        Session::flash('success', 'Offre ajouter avec succés');
        return redirect()->route('technical-offres-list');
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
        $offres = OffreType::all();
        $objectiftypes = ObjectifTypes::all();
        $OneOffre = offres::where('id',$id)->first();
        return view('admin.deptech.offres.edit',compact('offres','objectiftypes', 'OneOffre'));
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
        $validator = Validator::make($request->all(), [
            'offre_type'=> 'bail|required',
            'objectif_type'=> 'bail|required',
            'objectif_date'=>'bail|required',
            'objectifs'=>'bail|required',
        ]);
        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }
        try {
            $updatedOffre = offres::where('id',$id)->update([
                'offre_type_id' => $request->offre_type,
                'objectif_types_id' => $request->objectif_type,
                'objectif_date' => $request->objectif_date,
                'objectifs' => $request->objectifs,
            ]);
            $list = array();
            $updatedOffre = offres::where('id',$id)->first();
            $updateData = DataOffres::where('offres_id',$id)->get();
            foreach($updateData as $key=>$data)
            {
                array_push($list,$data->id);
                if($data->offre->ObjectifType->id == $updatedOffre->ObjectifType->id)
                {
                    if ($key == 0)
                    {
                        $update = DataOffres::where('id',$data->id)->first();
                        DataOffres::where('id',$update->id)->update([
                            'realisation_rate' => intval($update->realisation / $request->objectifs * 100),
                            'rest_per_objectifs' => $request->objectifs - $update->realisation 
                        ]);
                        if(count($updateData) == 1)
                        {
                            break;
                        }
                    }else
                    {
                        $lastValue = DataOffres::where('id',$list[$key-1])->first();
                        $update = DataOffres::where('id',$data->id)->first();
                        DataOffres::where('id',$update->id)->update([
                            'realisation_rate' => intval($update->realisation / $update->rest_per_objectifs * 100),
                            'rest_per_objectifs' => $lastValue->rest_per_objectifs - $update->realisation
                        ]);
                    }
                }
            }
        } catch (QueryException $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
        Session::flash('success', 'Offre mis a jour avec succés');
        return redirect()->route('technical-offres-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DataOffres::where('offres_id',$id)->delete();
            offres::where('id',$id)->delete();
        } catch (QueryException $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
        Session::flash('success', 'Offre supprimer avec succés');
        return redirect()->route('technical-offres-list');
    }
}
