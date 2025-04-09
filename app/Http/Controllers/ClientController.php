<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;

class ClientController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.register.clients.create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client): RedirectResponse
    {
        try {
            $client->delete();

            return redirect()->route('clients.index')
                ->with('success', 'Cliente excluído com sucesso!');
        } catch (QueryException $e) {
            report($e);

            return redirect()->route('clients.index')
                ->with('error', 'Cliente não pode ser excluído, pois está associado a um dispositivo.');
        } catch (\Exception $e) {
            report($e);

            return redirect()->route('clients.index')
                ->with('error', 'Cliente não pôde ser excluído.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client): View
    {
        return view('pages.register.clients.edit', compact('client'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $clients = Client::orderBy('name')->paginate(10);

        return view('pages.register.clients.index', [
            'rows' => $clients,
            'columns' => [
                'name' => 'Nome',
                'phone' => 'Telefone',

            ],
            'actions' => [
                'show' => 'clients.show',
                'edit' => 'clients.edit',
                'delete' => 'clients.destroy',
            ],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client): View
    {
        return view('pages.register.clients.show', compact('client'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request): RedirectResponse
    {
        Client::create($request->validated());

        return redirect()->route('clients.index')
            ->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client): RedirectResponse
    {
        $client->update($request->validated());

        return redirect()->route('clients.index')
            ->with('success', 'Cliente atualizado com sucesso!');
    }
}
