<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Database\QueryException;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::orderBy('name')->paginate(10);

        return view('pages.register.clients.index', [
            'lines' => $clients,
            'header' => [
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.register.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        Client::create($request->validated());

        return redirect()->route('clients.index')
            ->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('pages.register.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('pages.register.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->validated());

        return redirect()->route('clients.index')
            ->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        try{
            $client->delete();
    
            return redirect()->route('clients.index')
                ->with('success', 'Cliente excluído com sucesso!');
        }catch(QueryException $e){
            report($e);

            return redirect()->route('clients.index')
                ->with('error', 'Cliente não pode ser excluído, pois está associado a um dispositivo.');
        }
        catch(\Exception $e){
            report($e);

            return redirect()->route('clients.index')
                ->with('error', 'Cliente não pôde ser excluído.');
        }
    }
}
