<?php

namespace App\Http\Controllers\Admin;

use App\Models\offres;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $technical = offres::where('departements_id',1)->get();
        $commercial = offres::where('departements_id',2)->get();
        return view('admin.dashboard.index');
    }
}
