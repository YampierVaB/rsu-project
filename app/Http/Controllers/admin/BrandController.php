<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.brands.create');
        } catch (\Exception $e) {
            return redirect()->route('admin.brands.index')->with('error', 'Ocurrió un error al intentar crear una nueva marca.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:500',
            ]);

            Brand::create($request->all());
            return redirect()->route('admin.brands.index')->with('success', 'Marca registrada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('admin.brands.index')->with('error', 'Ocurrió un error al intentar registrar la marca.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $brand = Brand::findOrFail($id);
            return view('admin.brands.show', compact('brand'));
        } catch (\Exception $e) {
            return redirect()->route('admin.brands.index')->with('error', 'Ocurrió un error al intentar mostrar la marca.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $brand = Brand::findOrFail($id);
            return view('admin.brands.edit', compact('brand'));
        } catch (\Exception $e) {
            return redirect()->route('admin.brands.index')->with('error', 'Ocurrió un error al intentar editar la marca.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:500',
            ]);

            $brand = Brand::findOrFail($id);
            $brand->update($request->all());
            return redirect()->route('admin.brands.index')->with('success', 'Marca actualizada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('admin.brands.index')->with('error', 'Ocurrió un error al intentar actualizar la marca.');
        }
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $brand = Brand::findOrFail($id);
            $brand->delete();
            return redirect()->route('admin.brands.index')->with('success', 'Marca eliminada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('admin.brands.index')->with('error', 'Ocurrió un error al intentar eliminar la marca.');
        }

    }
}
