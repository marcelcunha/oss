<?php

namespace App\Http\Controllers;

use App\Enums\BudgetStatusEnum;
use App\Http\Requests\StoreBudgetRequest;
use App\Http\Requests\UpdateBudgetRequest;
use App\Models\Budget;
use App\Models\Checkin;
use App\Services\BudgetService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class BudgetController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Checkin $checkin): View
    {
        abort_if($checkin->budget()->exists(), 403, 'Só é possível haver um diagnóstico por check-in.');

        return view('pages.os.budgets.create', [
            'checkin' => $checkin,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Budget $budget, BudgetService $service) : RedirectResponse
    {
        abort_if($budget->status !== BudgetStatusEnum::PENDING, 403, 'Só é possível excluir orçamentos pendentes.');

        try {
            $service->delete($budget);

            return redirect()->route('budgets.index')
                ->with('success', 'Orçamento excluído com sucesso!');
        } catch (\Throwable $th) {
            report($th);

            return redirect()->back()
                ->with('error', 'Erro ao excluir orçamento!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Budget $budget, BudgetService $service): View
    {
        abort_if($budget->status !== BudgetStatusEnum::PENDING, 403, 'Só é possível editar orçamentos pendentes.');

        return view('pages.os.budgets.edit', $service->edit($budget));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(BudgetService $service): View
    {
        return view('pages.os.budgets.index', $service->index());
    }

    /**
     * Display the specified resource.
     */
    public function show(Budget $budget) : View
    {
        return view('pages.os.budgets.show', [
            'budget' => $budget->load(['checkin.client', 'checkin.device.brand']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBudgetRequest $request, BudgetService $service): RedirectResponse
    {
        try {
            $service->store(...$request->validated());

            return redirect()->route('budgets.index')
                ->with('success', 'Orçamento cadastrado com sucesso!');
        } catch (\Throwable $th) {
            report($th);

            return redirect()->back()
                ->with('error', 'Erro ao cadastrar orçamento!')
                ->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBudgetRequest $request, Budget $budget, BudgetService $service): RedirectResponse
    {
        abort_if($budget->status !== BudgetStatusEnum::PENDING, 403, 'Só é possível editar orçamentos pendentes.');

        try {
            $service->update($budget, ...$request->validated());

            return redirect()->route('budgets.index')
                ->with('success', 'Orçamento atualizado com sucesso!');
        } catch (\Throwable $th) {
            report($th);

            return redirect()->back()
                ->with('error', 'Erro ao atualizar orçamento!')
                ->withInput();
        }
    }
}
