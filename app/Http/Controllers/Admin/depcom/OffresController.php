<?php

namespace App\Http\Controllers\Admin\depcom;

use App\Models\ObjectifTypes;
use App\Models\OffreCommercial;
use App\Models\offres;
use App\Models\OffreType;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
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
        $offres = OffreCommercial::all();
        $objectiftypes = ObjectifTypes::all();
        $offrelist = offres::where('departements_id',2)->get();
        return view('admin.depcom.offres.index',compact('offres','objectiftypes','offrelist'));
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
            !offres::where('offre_commercial_id',$request->offre_type)
                ->where('objectif_types_id',$request->objectif_type)
                ->where('objectif_date',$request->objectif_date)
                ->first()
            )
            {
                $offre = new offres();
                $offre->offre_commercial_id = $request->offre_type;
                $offre->objectif_types_id = $request->objectif_type;
                $offre->departements_id = 2;
                $offre->documents_id = null;
                $offre->objectif_date = $request->objectif_date;
                $offre->objectifs = $request->objectifs;
                $offre->save();
            }else
            {
                Session::flash('error', 'Offre existe deja !');
                return redirect()->route('commercial-offres-list');
            }
        } catch (QueryException $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
        Session::flash('success', 'Offre ajouter avec succés');
        return redirect()->route('commercial-offres-list');
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
        $offres = OffreCommercial::get();
        $objectiftypes = ObjectifTypes::get();
        $OneOffre = offres::where('id',$id)->first();
        return view('admin.depcom.offres.edit',compact('offres','objectiftypes', 'OneOffre'));
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
            offres::where('id',$id)->update([
                'offre_commercial_id' => $request->offre_type,
                'objectif_types_id' => $request->objectif_type,
                'objectif_date' => $request->objectif_date,
                'objectifs' => $request->objectifs,
            ]);
        } catch (QueryException $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
        Session::flash('success', 'Offre mis a jour avec succés');
        return redirect()->route('commercial-offres-list');
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
