<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBudgetRequest;
use App\Http\Requests\UpdateBudgetRequest;
use App\Models\Budget;
use App\Services\BudgetService;

class BudgetController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(BudgetService $service)
    {
        return view('pages.os.budgets.create', $service->create());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Budget $budget, BudgetService $service)
    {
        try {
            $service->remove($budget);

            return redirect()->route('budgets.index')
                ->with('success', 'Orçamento excluído com sucesso!');
        } catch (\Throwable $th) {
            report($th);

            return redirect()->back()
                ->with('error', 'Erro ao excluir orçamento!')
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Budget $budget, BudgetService $service)
    {
        return view('pages.os.budgets.edit', $service->edit($budget));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(BudgetService $service)
    {
        return view('pages.os.budgets.index', $service->index());

    }

    /**
     * Display the specified resource.
     */
    public function show(Budget $budget)
    {
        return view('pages.os.budgets.show', [
            'budget' => $budget,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBudgetRequest $request, BudgetService $service)
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
    public function update(UpdateBudgetRequest $request, Budget $budget, BudgetService $service)
    {
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
