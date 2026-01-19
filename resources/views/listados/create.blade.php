@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h1 class="mb-4 text-primary">Crear Listado de Reparto</h1>

        {{-- Filtros --}}
        <form action="{{ route('listados.create') }}" method="GET" class="row g-3 align-items-end mb-4">
            <div class="col-md-4">
                <label for="zona" class="form-label">Zona</label>
                <select name="zona" id="zona" class="form-select" onchange="this.form.submit()">
                    <option value="TODOS" {{ request('zona', 'TODOS') == 'TODOS' ? 'selected' : '' }}>TODOS</option>
                    <option value="NOR" {{ request('zona') == 'NORTE' ? 'selected' : '' }}>NOR</option>
                    <option value="SUR" {{ request('zona') == 'SUR' ? 'selected' : '' }}>SUR</option>
                    <option value="GC" {{ request('zona') == 'GRAN CANARIA' ? 'selected' : '' }}>GC</option>
                    <option value="RHE" {{ request('zona') == 'RHENUS' ? 'selected' : '' }}>RHE</option>
                    <option value="TEN" {{ request('zona') == 'TENEPALMA' ? 'selected' : '' }}>TEN</option>
                    <option value="CLI" {{ request('zona') == 'CLI' ? 'selected' : '' }}>CLI</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="estado" class="form-label">Mostrar envíos</label>
                <select name="estado" id="estado" class="form-select" onchange="this.form.submit()">
                    <option value="no_enlistados" {{ request('estado', 'no_enlistados') == 'no_enlistados' ? 'selected' : '' }}>No enlistados</option>
                    <option value="enlistados" {{ request('estado') == 'enlistados' ? 'selected' : '' }}>Enlistados</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="buscar" class="form-label">Buscar cliente o pedido</label>
                <input type="text" name="buscar" id="buscar" class="form-control" value="{{ request('buscar') }}" placeholder="Ej: Cliente o P1234567">
            </div>
        </form>

        @if(isset($zona))
        <form action="{{ route('listados.store') }}" method="POST">
            @csrf
            <input type="hidden" name="zona" value="{{ request('zona', 'TODOS') }}">

            @if(request('zona') != 'TODOS' && request('estado', 'no_enlistados') == 'no_enlistados')
            <div class="mb-3 d-flex gap-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="seleccionarTodos(true)">Seleccionar todos</button>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="seleccionarTodos(false)">Deseleccionar todos</button>
            </div>
            @endif

            <div class="table-responsive mb-4">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Seleccionar</th>
                            <th>Cliente</th>
                            <th>Pedido</th>
                            <th>Zona</th>
                            <th>Destinatario</th>
                            <th>Bultos</th>
                            <th>Palets</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($envios as $envio)
                            <tr>
                                <td>
                                    <input type="checkbox" name="envios[]" value="{{ $envio->id }}" class="form-check-input envio-checkbox" {{ (request('zona') == 'TODOS' || request('estado') == 'enlistados') ? 'disabled' : '' }}>
                                </td>
                                <td>{{ $envio->nombre_cliente }}</td>
                                <td>{{ $envio->pedido }}</td>
                                <td>{{ $envio->zona }}</td>
                                <td>{{ $envio->destinatario ?? '-' }}</td>
                                <td>{{ $envio->bultos ?? '-' }}</td>
                                <td>{{ $envio->palets ?? '-' }}</td>
                                <td>{{ $envio->created_at->format('d/m/Y') }}</td>
                                <td>{{ $envio->created_at->format('H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">No hay envíos para los filtros seleccionados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(request('zona') != 'TODOS' && request('estado', 'no_enlistados') == 'no_enlistados')
                <button type="submit" class="btn btn-primary">Crear Listado</button>
            @else
                <div class="alert alert-warning">Debe seleccionar una zona específica y mostrar envíos no enlistados para crear un listado.</div>
            @endif
        </form>

        <script>
            function seleccionarTodos(seleccionar) {
                document.querySelectorAll('.envio-checkbox').forEach(cb => {
                    cb.checked = seleccionar;
                });
            }
        </script>
        @endif
    </div>
</div>
@endsection
