@extends('adminlte::page')

@section('title', 'Marcas')

@section('content')


    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Lista de Marcas</h3>
            <button id="btnNuevo" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo
            </button>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered text-center" id="TablaMarcas">
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
                            <td><img src="{{ $brand->logo == '' ? asset('storage/brands/no_image.png') : asset($brand->logo) }}"
                                    alt="" width="80px" height="50px"></td>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->description }}</td>
                            <td>{{ $brand->created_at->format('d/m/Y') }}</td>
                            <td>{{ $brand->updated_at->format('d/m/Y') }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning btnEditar" id="{{ $brand->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="confirmDelete({{ $brand->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $brand->id }}"
                                    action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Modal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{-- @include('admin.brands.template.form') --}}
                            ...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    
    <script>
        $('#TablaMarcas').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json'
            }, 
            // ajax: {
            //     url: '{{ route('admin.brands.index') }}',
            //     type: 'GET',
            //     dataSrc: ''
            // },
            columns: [
                {
                    data: 'logo'
                },
                {
                    data: 'name'
                },
                {
                    data: 'description'
                },
                {
                    data: 'created_at',
                    // render: function(data) {
                    //     return moment(data).format('DD/MM/YYYY');
                    // }
                },
                {
                    data: 'updated_at',
                    // render: function(data) {
                    //     return moment(data).format('DD/MM/YYYY');
                    // }
                },
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false
                }
             ]

        });


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


        $('#btnNuevo').click(function() {
            $.ajax({
                url: '{{ route('admin.brands.create') }}',
                type: 'GET',
                success: function(response) {
                    $('#modalCenterTitle').html('Nueva Marca');
                    $('#modalCenter .modal-body').html(response);
                    $('#modalCenter').modal('show');

                    $('#modalCenter form').on('submit', function(e){
                        e.preventDefault();
                        var formData = new FormData(this);

                        $.ajax({
                            url: '{{ route('admin.brands.store') }}',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                $('#modalCenter').modal('hide');
                                console.log('response', response);
                                // Actualizar la tabla
                                updateTable();

                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Éxito!',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            }
                        });
                    })
                }
            });
        });

        $(document).on('click', '.btnEditar', function(){
            var id = $(this).attr('id');
            $.ajax({
                url: '{{ route('admin.brands.edit', 'id') }}'.replace('id', id),
                type: 'GET',
                success: function(response) {
                    $('#modalCenterTitle').html('Editar Marca');
                    $('#modalCenter .modal-body').html(response);
                    $('#modalCenter').modal('show');

                    $('#modalCenter form').on('submit', function(e){
                        e.preventDefault();
                        var formData = new FormData(this);

                        $.ajax({
                            url: '{{ route('admin.brands.update', 'id') }}'.replace('id', id),
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                $('#modalCenter').modal('hide');
                                console.log('response', response);
                                // Actualizar la tabla
                                updateTable();

                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Éxito!',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            }
                        });
                    })
                }
            });
        })

        function updateTable() {
            var table = $('#TablaMarcas').DataTable();
            table.ajax.reload(null, false);
        }
        
    </script>
@endsection
