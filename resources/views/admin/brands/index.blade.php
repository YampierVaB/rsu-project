@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Marcas</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Marcas</h3>
            <a href="{{ route('admin.brands.create') }}" class="btn btn-primary float-right">Nuevo</a>
        </div>
        <div class="card-body">
            <table>
                <thead>
                    <tr>
                        <th class="text-center" style="width: 10%;">Logo</th>
                        <th class="text-left" style="width: 20%;">Nombre</th>
                        <th class="text-left" style="width: 30%;">Descripción</th>
                        <th class="text-center" style="width: 20%;">Creación</th>
                        <th class="text-center" style="width: 20%;">Actualización</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Add rows for brands here -->
                    @foreach ($brands as $brand)
                        <tr>
                            <td></td>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->description }}</td>
                            <td>{{ $brand->created_at }}</td>
                            <td>{{ $brand->updated_at }}</td>
                            <td> <a href="{{ route('admin.brands.edit', $brand->id) }}"><i class="fa-solid fa-pen"></i></a></td>
                            <td>
                                <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
