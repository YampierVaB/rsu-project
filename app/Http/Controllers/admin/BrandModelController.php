<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brandmodel;
use App\Models\Brand;

class BrandModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $models = Brandmodel::all();
        $models = Brandmodel::select(
            'brandmodels.id', 'brandmodels.name as model_name', 'code', 'b.name as brand_name', 'brandmodels.description', 'brandmodels.created_at', 'brandmodels.updated_at'
            )
            ->join('brands as b', 'brandmodels.brand_id', '=', 'b.id')
            ->get();

        return view('admin.models.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::pluck('name', 'id');
        return view('admin.models.create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brandmodels,name',
            'code' => 'required',
            'brand_id' => 'required',
            'description' => 'required',
        ]);

        try {
            Brandmodel::create($request->all());
            return redirect()->route('admin.models.index')->with('success', 'Modelo creado exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('admin.models.index')->with('error', 'Error al crear el modelo: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
