@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Historial de Listados</h1>

    @if ($listados->isEmpty())
        <div class="alert alert-info">
            No hay listados archivados.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Zona</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Envíos</th>
                        <th scope="col">PDF</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listados as $listado)
                        <tr>
                            <td>{{ $listado->id }}</td>
                            <td>{{ $listado->zona }}</td>
                            <td>{{ $listado->fecha }}</td>
                            <td>{{ $listado->envios_count }}</td>
                            <td>
                                @if ($listado->pdf_path)
                                    <a href="{{ route('listados.descargar', $listado->id) }}" class="btn btn-sm btn-outline-success" target="_blank">
                                        Ver PDF
                                    </a>
                                @else
                                    <span class="text-muted">No disponible</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
