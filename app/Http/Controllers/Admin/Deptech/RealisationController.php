<?php

namespace App\Http\Controllers\Admin\Deptech;

use App\Models\offres;
use App\Models\DataOffres;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
            'offres_id'=> 'bail|required',
            'realisation_date'=> 'bail|required',
            'realisation'=>'bail|required',
            'realisation_rate'=>'bail|required',
            'rest_per_objectifs'=>'bail|required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }
        try {
            $data = new DataOffres();
            $data->offres_id = $request->offres_id;
            $data->realisation_date = $request->realisation_date;
            $data->realisation = $request->realisation;
            $data->realisation_rate = $request->realisation_rate;
            $data->rest_per_objectifs = $request->rest_per_objectifs;
            $data->save(); 

        } catch (QueryException $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
        Session::flash('success', 'Realisation ajouter avec succés');
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
        return view('admin.deptech.offres.realisations',compact('offre','realisations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $offre = offres::where('id',$id)->first();
        $realisation = DataOffres::where('offres_id',$id)->first();
        return view('admin.deptech.offres.realisation.edit',compact('offre','realisation'));
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
            'realisation_date'=> 'bail|required',
            'realisation'=>'bail|required',
            'realisation_rate'=>'bail|required',
            'rest_per_objectifs'=>'bail|required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', $validator->errors()->first());
            return redirect()->back()->withInput();
        }
        try {
            DataOffres::where('id',$id)->update([
                'realisation_date' => $request->realisation_date,
                'realisation' => $request->realisation,
                'realisation_rate' => $request->realisation_rate,
                'rest_per_objectifs' => $request->rest_per_objectifs,
            ]); 

        } catch (QueryException $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
        Session::flash('success', 'Realisation mis a jour avec succés');
        return redirect()->back()->withInput();
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
            DataOffres::where('id',$id)->delete();
        } catch (QueryException $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
        Session::flash('success', 'Offre supprimer avec succés');
        return redirect()->back()->withInput();
    }
}
