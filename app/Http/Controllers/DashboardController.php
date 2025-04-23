<?php

namespace App\Http\Controllers;

use App\Models\DataFeed;
use App\Services\DashboardService;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(DashboardService $service): View
    {
        return view('pages/dashboard/dashboard', $service->index());
    }
}
