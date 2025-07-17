<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('pages.os.services.index')
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view()
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request) : RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service) : View
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service) : RedirectResponse
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service) : RedirectResponse
    {
        //
    }
}
