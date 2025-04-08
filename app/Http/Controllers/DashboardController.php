<?php

namespace App\Http\Controllers;

use App\Models\DataFeed;

class DashboardController extends Controller
{
    public function index()
    {
        $dataFeed = new DataFeed;

        return view('pages/dashboard/dashboard', compact('dataFeed'));
    }
}
