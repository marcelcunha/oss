<?php

namespace App\Services;

use App\Enums\QuoteStatusEnum;
use App\Models\Budget;
use App\Models\Checkin;
use stdClass;

class DashboardService
{
    public function index(): array
    {
        $data = new stdClass();

        $checkins = new stdClass();
        $checkins->label = 'Checkins';
        $checkins->total = Checkin::whereDate('date', '>=', now()->subWeek())->count();
        $checkins->icon = 'document-check';
        $data->checkins = $checkins;
        
        $checkouts = new stdClass();
        $checkouts->label = 'Checkouts';
        $checkouts->total = Budget::whereDate('budget_date', '>=', now()->subWeek())->where('status', QuoteStatusEnum::REJECTED)->count();
        $checkouts->icon = 'wrench-screwdriver';
        $data->checkouts = $checkouts;

        $budgets = new stdClass();
        $budgets->label = 'Orçamentos Pendentes';
        $budgets->total = Budget::whereDate('budget_date', '>=', now()->subWeek())->where('status', QuoteStatusEnum::PENDING)->count();
        $budgets->icon = 'wrench-screwdriver';
        $data->budgets = $budgets;

        return [
            'data' => $data,
        ];
    }
}
