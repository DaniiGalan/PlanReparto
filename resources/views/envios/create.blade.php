@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Envío</h2>

    <form method="POST" action="{{ route('envios.store') }}">
        @csrf

        {{-- Zona --}}
        <div class="mb-3">
            <label for="zona" class="form-label">Zona</label>
            <select name="zona" id="zona" class="form-select" required>
                <option value="">Selecciona una zona</option>
                <option value="Norte" {{ old('zona') == 'Norte' ? 'selected' : '' }}>Norte</option>
                <option value="Sur" {{ old('zona') == 'Sur' ? 'selected' : '' }}>Sur</option>
                <option value="Gran Canaria" {{ old('zona') == 'Gran Canaria' ? 'selected' : '' }}>Gran Canaria</option>
                <option value="Rhenus" {{ old('zona') == 'Rhenus' ? 'selected' : '' }}>Rhenus</option>
                <option value="Tenepalma" {{ old('zona') == 'Tenepalma' ? 'selected' : '' }}>Tenepalma</option>
                <option value="Cli" {{ old('zona') == 'Cli' ? 'selected' : '' }}>Cli</option>
            </select>
        </div>

        {{-- Cliente --}}
        <div class="mb-3">
            <label for="nombre_cliente" class="form-label">Cliente</label>
            <input type="text" name="nombre_cliente" id="nombre_cliente" class="form-control" required value="{{ old('nombre_cliente') }}">
        </div>

        {{-- Casilla de Incidencia --}}
        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" id="es_incidencia">
            <label class="form-check-label" for="es_incidencia">
                ES UNA INCIDENCIA
            </label>
        </div>

        {{-- Pedido --}}
        <div class="mb-3">
            <label for="pedido" class="form-label">Número de pedido</label>
            <input type="text" name="pedido" id="pedido" class="form-control" required value="{{ old('pedido') }}">
        </div>

        {{-- Checkbox para activar destinatario --}}
        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" value="1" id="activar_destinatario">
            <label class="form-check-label" for="activar_destinatario">
                OTRO DESTINATARIO
            </label>
        </div>

        {{-- Destinatario --}}
        <div class="mb-3">
            <label for="destinatario" class="form-label">Destinatario</label>
            <input type="text" name="destinatario" id="destinatario" class="form-control" value="{{ old('destinatario') }}" disabled>
        </div>

        {{-- Bultos --}}
        <div class="mb-3">
            <label for="bultos" class="form-label">Número de bultos</label>
            <input type="number" name="bultos" id="bultos" class="form-control" min="1" value="{{ old('bultos', 1) }}">
        </div>

        {{-- Checkbox para generar etiquetas por palet --}}
        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" value="1" id="usar_palets" name="usar_palets">
            <label class="form-check-label" for="usar_palets">
                ETIQUETAS POR PALETS
            </label>
        </div>

        {{-- Palets --}}
        <div class="mb-3">
            <label for="palets" class="form-label">Número de palets</label>
            <input type="number" name="palets" id="palets" class="form-control" min="1" value="{{ old('palets', 1) }}" disabled>
        </div>

        {{-- Botón de envío --}}
        <button type="submit" class="btn btn-primary">Generar etiqueta</button>
    </form>
</div>

<script>
    // Activar/desactivar campo destinatario
    document.getElementById('activar_destinatario').addEventListener('change', function () {
        document.getElementById('destinatario').disabled = !this.checked;
    });

    // Activar/desactivar campo palets
    document.getElementById('usar_palets').addEventListener('change', function () {
        document.getElementById('palets').disabled = !this.checked;
    });

    // Incidencia: poner texto y bloquear pedido
    document.getElementById('es_incidencia').addEventListener('change', function () {
        const pedidoInput = document.getElementById('pedido');
        if (this.checked) {
            pedidoInput.value = '⚠ INCIDENCIA ⚠';
            pedidoInput.disabled = true;
        } else {
            pedidoInput.value = '';
            pedidoInput.disabled = false;
        }
    });
</script>
@endsection
