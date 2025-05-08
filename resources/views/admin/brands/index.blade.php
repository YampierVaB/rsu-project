@extends('adminlte::page')

@section('title', 'Marcas')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Lista de Marcas</h3>
            <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered text-center" id="TablaMarcas">
                <thead class="thead-dark">
                    <tr>
                        <th>Logo</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Creación</th>
                        <th>Actualización</th>
                        <th>Acciones</th>
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
                                <button class="btn btn-sm btn-danger" onclick="confirmDelete({{ $brand->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $brand->id }}" action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script>
        
        $('#TablaMarcas').DataTable();
    

        function confirmDelete(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }

// Ocultar automáticamente las alertas después de 5 segundos
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 500); // Eliminar del DOM después de la animación
            }
        }, 3000); // 3000 ms = 3 segundos


    </script>
@endsection