@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Envío</h2>

    <form method="POST" action="{{ route('envios.store') }}" id="form-envio" novalidate>
        @csrf

        {{-- Zona --}}
        <div class="mb-3">
            <label for="zona" class="form-label">Zona</label>
            <select name="zona" id="zona" class="form-select @error('zona') is-invalid @enderror" required>
                <option value="">Selecciona una zona</option>
                <option value="NOR">NOR</option>
                <option value="SUR">SUR</option>
                <option value="GC">GC</option>
                <option value="RHE">RHE</option>
                <option value="TEN">TEN</option>
                <option value="CLI">CLI</option>
            </select>
            @error('zona')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        {{-- Cliente --}}
        <div class="mb-3">
            <label for="nombre_cliente" class="form-label">Cliente</label>
            <input type="text" name="nombre_cliente" id="nombre_cliente"
                   class="form-control @error('nombre_cliente') is-invalid @enderror"
                   required maxlength="27" value="{{ old('nombre_cliente') }}">
            @error('nombre_cliente')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        {{-- Incidencia --}}
        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" id="es_incidencia">
            <label class="form-check-label" for="es_incidencia">ES UNA INCIDENCIA</label>
        </div>

        {{-- Pedido --}}
        <div class="mb-3">
            <label for="pedido" class="form-label">Número de pedido</label>
            <input type="text" name="pedido" id="pedido"
                   class="form-control @error('pedido') is-invalid @enderror"
                   required pattern="^P\d{7}|INCIDENCIA$" maxlength="20"
                   value="{{ old('pedido') }}">
            @error('pedido')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        {{-- Otro destinatario --}}
        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" id="activar_destinatario" name="activar_destinatario" {{ old('activar_destinatario') ? 'checked' : '' }}>
            <label class="form-check-label" for="activar_destinatario">OTRO DESTINATARIO</label>
        </div>

        <div class="mb-3">
            <label for="destinatario" class="form-label">Destinatario</label>
            <input type="text" name="destinatario" id="destinatario"
                   class="form-control @error('destinatario') is-invalid @enderror"
                   maxlength="27" value="{{ old('destinatario') }}" {{ old('activar_destinatario') ? '' : 'disabled' }}>
            @error('destinatario')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        {{-- Bultos --}}
        <div class="mb-3">
            <label for="bultos" class="form-label">Número de bultos</label>
            <input type="number" name="bultos" id="bultos"
                   class="form-control @error('bultos') is-invalid @enderror"
                   min="1" step="1" value="{{ old('bultos', 1) }}">
            @error('bultos')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        {{-- Palets --}}
        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" id="usar_palets" name="usar_palets" value="1" {{ old('usar_palets') ? 'checked' : '' }}>
            <label class="form-check-label" for="usar_palets">ETIQUETAS POR PALETS</label>
        </div>

        <div class="mb-3">
            <label for="palets" class="form-label">Número de palets</label>
            <input type="number" name="palets" id="palets"
                   class="form-control @error('palets') is-invalid @enderror"
                   min="1" step="1" value="{{ old('palets', 1) }}" {{ old('usar_palets') ? '' : 'disabled' }}>
            @error('palets')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        {{-- Botones --}}
        <div class="mt-4 d-flex gap-2">
            <button type="button" class="btn btn-primary" id="abrir-modal">Generar etiqueta</button>
            <button type="reset" class="btn btn-secondary">Limpiar</button>
        </div>
    </form>
</div>

{{-- Modal de confirmación --}}
<div class="modal fade" id="modalConfirmacion" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmar Envío</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <pre id="resumenEnvio" style="white-space: pre-wrap; word-break: break-word;"></pre>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" id="confirmarEnvio">Confirmar</button>
      </div>
    </div>
  </div>
</div>

<script>
    const form = document.getElementById('form-envio');
    const abrirModal = document.getElementById('abrir-modal');
    const confirmarEnvio = document.getElementById('confirmarEnvio');
    const resumenEnvio = document.getElementById('resumenEnvio');

    const nombre = document.getElementById('nombre_cliente');
    const zona = document.getElementById('zona');
    const pedido = document.getElementById('pedido');
    const incidencia = document.getElementById('es_incidencia');
    const activarDestinatario = document.getElementById('activar_destinatario');
    const destinatario = document.getElementById('destinatario');
    const usarPalets = document.getElementById('usar_palets');
    const palets = document.getElementById('palets');
    const bultos = document.getElementById('bultos');

    activarDestinatario.addEventListener('change', () => {
        destinatario.disabled = !activarDestinatario.checked;
    });

    usarPalets.addEventListener('change', () => {
        palets.disabled = !usarPalets.checked;
    });

    incidencia.addEventListener('change', () => {
        if (incidencia.checked) {
            pedido.value = 'INCIDENCIA';
            pedido.disabled = true;
        } else {
            pedido.disabled = false;
            pedido.value = '';
        }
    });

    form.addEventListener('reset', () => {
        setTimeout(() => {
            activarDestinatario.checked = false;
            destinatario.disabled = true;
            destinatario.value = '';
            usarPalets.checked = false;
            palets.disabled = true;
            incidencia.checked = false;
            pedido.disabled = false;
            pedido.value = '';
            form.classList.remove('was-validated');
        }, 0);
    });

    abrirModal.addEventListener('click', () => {
        const resumen = [
            `Cliente: ${nombre.value}`,
            `Pedido: ${pedido.value}`,
            `Zona: ${zona.value}`,
            activarDestinatario.checked ? `Destinatario: ${destinatario.value}` : null,
            `Bultos: ${bultos.value}`,
            usarPalets.checked ? `Palets: ${palets.value}` : null
        ].filter(Boolean).join('\\n');

        resumenEnvio.innerText = resumen;
        new bootstrap.Modal(document.getElementById('modalConfirmacion')).show();
    });

    confirmarEnvio.addEventListener('click', () => {
        if (activarDestinatario.checked) {
            destinatario.disabled = false;
        }
        if (incidencia.checked) {
            pedido.disabled = false;
            pedido.value = 'INCIDENCIA';
        }
        form.submit();
    });

    form.addEventListener('submit', function (e) {
        if (!form.checkValidity()) {
            e.preventDefault();
            form.classList.add('was-validated');
        }
    });

    pedido.addEventListener('input', () => {
        const valid = /^P\\d{7}$/.test(pedido.value) || pedido.value === 'INCIDENCIA';
        pedido.setCustomValidity(valid ? '' : 'Debe ser P seguido de 7 dígitos o \"INCIDENCIA\"');
    });
</script>
@endsection
