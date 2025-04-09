<?php

namespace App\Http\Controllers;

use App\Models\DataFeed;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $dataFeed = new DataFeed;

        return view('pages/dashboard/dashboard', compact('dataFeed'));
    }
}
