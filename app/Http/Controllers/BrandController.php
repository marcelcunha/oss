<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Database\QueryException;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderBy('name')->paginate(10);

        return view('pages.register.brands.index', [
            'header' => ['name' => 'Nome'],
            'lines' => $brands,
            'actions' => ['edit' => 'brands.edit', 'delete' => 'brands.destroy'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.register.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        Brand::create($request->validated());

        return redirect()->route('brands.index')
            ->with('success', 'Marca cadastrada com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('pages.register.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update($request->validated());

        return redirect()->route('brands.index')
            ->with('success', 'Marca atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        try {
            $brand->delete();
            return redirect()->route('brands.index')->with('success', 'Marca excluída com sucesso.');
        } catch (QueryException $e) {
            report($e);
            return redirect()->route('brands.index')->with('error', 'Marca não pode ser excluída, pois está associada a um dispositivo.');
        } catch (\Exception $e) {
            report($e);
            return redirect()->route('brands.index')->with('error', 'Marca não pode ser excluída.');
        }
    }
}
