<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('users.dashboard.index');
    }
}
