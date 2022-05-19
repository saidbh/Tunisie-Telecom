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
        $offrelist = offres::all();
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
            $offre = new offres();
            $offre->offre_type_id = $request->offre_type;
            $offre->objectif_types_id = $request->objectif_type;
            $offre->departements_id = 1;
            $offre->documents_id = null;
            $offre->objectif_date = $request->objectif_date;
            $offre->objectifs = $request->objectifs;
            $offre->save();
/*             $data = new DataOffres();
            $data->offres_id = $offre->id;
            $data->objectifs = $request->objectifs;
            $data->realisation = $request->realisation;
            $data->realisation_rate = $request->realisation_rate;
            $data->rest_per_objectifs = $request->rest_per_objectifs;
            $data->save(); */

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
            'start_date'=>'bail|required',
            'end_date'=>'bail|required',
            'objectifs'=>'bail|required',
            'realisation'=>'bail|required',
            'realisation_rate'=>'bail|required',
            'rest_per_objectifs'=>'bail|required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }
        try {
            offres::where('id',$id)->update([
                'offre_type_id' => $request->offre_type,
                'objectif_types_id' => $request->objectif_type,
                'date_from' => $request->start_date,
                'date_to' => $request->end_date,
            ]);

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
