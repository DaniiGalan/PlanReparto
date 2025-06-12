@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h1 class="mb-4 text-primary">Crear Listado de Reparto</h1>

        <form action="{{ route('listados.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="zona" class="form-label">Zona del listado</label>
                <select name="zona" id="zona" class="form-select" required>
                    <option value="" disabled selected>Seleccione zona</option>
                    <option value="NORTE">NORTE</option>
                    <option value="SUR">SUR</option>
                    <option value="GRAN CANARIA">GRAN CANARIA</option>
                    <option value="RHENUS">RHENUS</option>
                    <option value="TENEPALMA">TENEPALMA</option>
                </select>
            </div>

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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($envios as $envio)
                            <tr>
                                <td>
                                    <input type="checkbox" name="envios[]" value="{{ $envio->id }}" class="form-check-input">
                                </td>
                                <td>{{ $envio->nombre_cliente }}</td>
                                <td>{{ $envio->direccion }}</td>
                                <td>{{ $envio->zona }}</td>
                                <td>{{ $envio->nombre_cliente }}</td>
                                <td>{{ $envio->bultos ?? '-' }}</td>
                                <td>{{ $envio->palets ?? '-' }}</td>
                                <td>{{ $envio->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <button type="submit" class="btn btn-primary">Crear Listado</button>
        </form>
    </div>
</div>
@endsection
