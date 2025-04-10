<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCheckinRequest;
use App\Http\Requests\UpdateCheckinRequest;
use App\Models\Checkin;
use App\Services\CheckinService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CheckinController extends Controller
{
     /**
     * Show the form for creating a new resource.
     */
    public function create(CheckinService $service): View
    {
        return view('pages.os.checkins.create', $service->create());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checkin $checkin, CheckinService $service): RedirectResponse
    {
        try {
            $service->remove($checkin);

            return redirect()->route('checkins.index')
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
    public function edit(Checkin $checkin, CheckinService $service): View
    {
        return view('pages.os.checkins.edit', $service->edit($checkin));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CheckinService $service): View
    {
        return view('pages.os.checkins.index', $service->index());

    }

    /**
     * Display the specified resource.
     */
    public function show(Checkin $checkin): View
    {
        return view('pages.os.checkins.show', [
            'checkin' => $checkin,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCheckinRequest $request, CheckinService $service): RedirectResponse
    {
        try {
            $service->store(...$request->validated());

            return redirect()->route('checkins.index')
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
    public function update(UpdateCheckinRequest $request, Checkin $checkin, CheckinService $service): RedirectResponse
    {
        try {
            $service->update($checkin, ...$request->validated());

            return redirect()->route('checkins.index')
                ->with('success', 'Orçamento atualizado com sucesso!');
        } catch (\Throwable $th) {
            report($th);

            return redirect()->back()
                ->with('error', 'Erro ao atualizar orçamento!')
                ->withInput();
        }
    }
}
