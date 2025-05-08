@extends('adminlte::page')

@section('title', 'Marcas')

@section('content_header')
    <h1><i class="fas fa-tags"></i> Gestión de Marcas</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title"><i class="fas fa-list"></i> Lista de Marcas</h3>
            <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead class="thead-dark">
                    <tr>
                        <th><i class="fas fa-image"></i> Logo</th>
                        <th><i class="fas fa-font"></i> Nombre</th>
                        <th><i class="fas fa-align-left"></i> Descripción</th>
                        <th><i class="fas fa-calendar-alt"></i> Creación</th>
                        <th><i class="fas fa-calendar-check"></i> Actualización</th>
                        <th><i class="fas fa-cogs"></i> Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                        <tr>
                            <td>
                                @if ($brand->logo)
                                    <img src="{{ asset('storage/' . $brand->logo) }}" alt="Logo" class="img-thumbnail" style="width: 50px; height: 50px;">
                                @else
                                    <i class="fas fa-image text-muted"></i>
                                @endif
                            </td>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->description }}</td>
                            <td>{{ $brand->created_at->format('d/m/Y') }}</td>
                            <td>{{ $brand->updated_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta marca?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection