<?php

namespace App\Http\Controllers\Admin\System;

use App\Models\DataOffres;
use App\Models\SubOffreCommercial;
use App\Models\departements;
use App\Models\ObjectifTypes;
use App\Models\offres;
use App\Models\OffreType;
use App\Models\OffreCommercial;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DictionaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offres = offres::all();
        $depart = departements::all();
        $objectifs = ObjectifTypes::all();
        $offretype = OffreType::all();
        $departement = departements::all();
        $offreCom = OffreCommercial::all();
        $suboffreCom = SubOffreCommercial::all();
        return view('admin.system.dictionary.index', compact('offres','depart','objectifs','offretype','departement','offreCom','suboffreCom'));
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
        switch ($request->action)
        {
            case 'objectifs':
                try {
                    $objectif = new ObjectifTypes();
                    $objectif->name = $request->objectifs;
                    $objectif->description = $request->description;
                    $objectif->save();
                } catch (QueryException $e) {
                    Session::flash('error', $e->getMessage());
                    return redirect()->back()->withInput();
                }
                Session::flash('success', 'Objectif ajouter avec succés');
                return redirect()->route('system-dictionary');
            case 'offres':
                try {
                    $offre = new OffreType();
                    $offre->name = $request->offres;
                    $offre->description = $request->description;
                    $offre->save();
                } catch (QueryException $e) {
                    Session::flash('error', $e->getMessage());
                    return redirect()->back()->withInput();
                }
                Session::flash('success', 'Offre ajouter avec succés');
                return redirect()->route('system-dictionary');
            case 'offrescom':
                try {
                    $offrecom = new OffreCommercial();
                    $offrecom->name = $request->offres;
                    $offrecom->description = $request->description;
                    $offrecom->save();
                } catch (QueryException $e) {
                    Session::flash('error', $e->getMessage());
                    return redirect()->back()->withInput();
                }
                Session::flash('success', 'Offre ajouter avec succés');
                return redirect()->route('system-dictionary');
            case 'suboffrescom':
                try {
                    $suboffrecom = new SubOffreCommercial();
                    $suboffrecom->offre_commercial_id = $request->Comoffres;
                    $suboffrecom->name = $request->suboffres;
                    $suboffrecom->description = $request->description;
                    $suboffrecom->save();
                } catch (QueryException $e) {
                    Session::flash('error', $e->getMessage());
                    return redirect()->back()->withInput();
                }
                Session::flash('success', 'Sous Offre ajouter avec succés');
                return redirect()->route('system-dictionary');
            case 'departement':
                try {
                    $dep = new departements();
                    $dep->name = $request->departement;
                    $dep->description = $request->description;
                    $dep->save();
                } catch (QueryException $e) {
                    Session::flash('error', $e->getMessage());
                    return redirect()->back()->withInput();
                }
                Session::flash('success', 'Departement ajouter avec succés');
                return redirect()->route('system-dictionary');
        }
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
        switch ($request->action)
        {
            case 'objectifs':
                try {
                    ObjectifTypes::where('id',$id)->update([
                        'name' => $request->objectifs,
                        'description' => $request->description,
                    ]);
                } catch (QueryException $e) {
                    Session::flash('error', $e->getMessage());
                    return redirect()->back()->withInput();
                }
                Session::flash('success', 'Objectif modifier avec succés');
                return redirect()->route('system-dictionary');
            case 'offres':
                try {
                    OffreType::where('id',$id)->update([
                        'name' => $request->offres,
                        'description' => $request->description,
                    ]);
                } catch (QueryException $e) {
                    Session::flash('error', $e->getMessage());
                    return redirect()->back()->withInput();
                }
                Session::flash('success', 'Offre modifier avec succés');
                return redirect()->route('system-dictionary');
            case 'offrescom':
                try {
                    OffreCommercial::where('id',$id)->update([
                        'name' => $request->offres,
                        'description' => $request->description,
                    ]);
                } catch (QueryException $e) {
                    Session::flash('error', $e->getMessage());
                    return redirect()->back()->withInput();
                }
                Session::flash('success', 'Offre modifier avec succés');
                return redirect()->route('system-dictionary');
            case 'suboffrescom':
                try {
                    SubOffreCommercial::where('id',$id)->update([
                        'offre_commercial_id' => $request->Comoffres,
                        'name' => $request->suboffres,
                        'description' => $request->description,
                    ]);
                } catch (QueryException $e) {
                    Session::flash('error', $e->getMessage());
                    return redirect()->back()->withInput();
                }
                Session::flash('success', 'Sous Offre modifier avec succés');
                return redirect()->route('system-dictionary');
            case 'departement':
                try {
                    departements::where('id',$id)->update([
                        'name' => $request->departement,
                        'description' => $request->description,
                    ]);
                } catch (QueryException $e) {
                    Session::flash('error', $e->getMessage());
                    return redirect()->back()->withInput();
                }
                Session::flash('success', 'Departement modifier avec succés');
                return redirect()->route('system-dictionary');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        switch ($request->action)
        {
            case 'objectifs':
                try {
                    ObjectifTypes::where('id',$id)->delete();
                } catch (QueryException $e) {
                    Session::flash('error', $e->getMessage());
                    return redirect()->back()->withInput();
                }
                Session::flash('success', 'Objectif supprimer avec succés');
                return redirect()->route('system-dictionary');
            case 'offres':
                try {
                    OffreType::where('id',$id)->delete();
                } catch (QueryException $e) {
                    Session::flash('error', $e->getMessage());
                    return redirect()->back()->withInput();
                }
                Session::flash('success', 'Offre supprimer avec succés');
                return redirect()->route('system-dictionary');
            case 'offrescom':
                try {
                    OffreCommercial::where('id',$id)->delete();
                } catch (QueryException $e) {
                    Session::flash('error', $e->getMessage());
                    return redirect()->back()->withInput();
                }
                Session::flash('success', 'Offre supprimer avec succés');
                return redirect()->route('system-dictionary');
            case 'suboffrescom':
                try {
                    SubOffreCommercial::where('id',$id)->delete();
                } catch (QueryException $e) {
                    Session::flash('error', $e->getMessage());
                    return redirect()->back()->withInput();
                }
                Session::flash('success', 'Offre supprimer avec succés');
                return redirect()->route('system-dictionary');
            case 'departement':
                try {
                    departements::where('id',$id)->delete();
                } catch (QueryException $e) {
                    Session::flash('error', $e->getMessage());
                    return redirect()->back()->withInput();
                }
                Session::flash('success', 'Departement supprimer avec succés');
                return redirect()->route('system-dictionary');
        }
    }
}
