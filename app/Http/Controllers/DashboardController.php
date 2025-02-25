<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminIndex()
    {
        return view('admin.dashboard');
    }

    public function guruIndex()
    {
        return view('guru.dashboard');
    }

    public function muridIndex()
    {
        return view('murid.dashboard');
    }

    public function orangTuaIndex()
    {
        return view('orangtua.dashboard');
    }
}
