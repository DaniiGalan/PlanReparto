@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Historial de Envíos</h1>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Zona</th>
                        <th>Fecha</th>
                        <th>Etiquetas</th>
                        <th>PDF</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($envios as $envio)
                        <tr>
                            <td>{{ $envio->id }}</td>
                            <td>{{ $envio->nombre_cliente }}</td>
                            <td>{{ $envio->zona }}</td>
                            <td>{{ $envio->created_at->format('d/m/Y') }}</td>
                            <td>
                                @php
                                    $etiquetas = $envio->palets ?? $envio->bultos ?? 1;
                                @endphp
                                {{ $etiquetas }} {{ $etiquetas === 1 ? 'etiqueta' : 'etiquetas' }}
                            </td>
                            <td>
                                <a href="{{ route('envios.etiqueta', $envio->id) }}" class="btn btn-sm btn-outline-primary"
                                    target="_blank">
                                    Ver / Imprimir
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No hay envíos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4 mb-4 gap-2">
            <div class="text-muted small text-center text-sm-start">
                Mostrando {{ $envios->firstItem() }} a {{ $envios->lastItem() }} de {{ $envios->total() }} resultados
            </div>
            <div class="d-flex justify-content-center justify-content-sm-end">
                {{ $envios->links('pagination::bootstrap-5') }}
            </div>
        </div>


    </div>
@endsection
