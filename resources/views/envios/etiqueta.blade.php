<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Etiqueta de Envío</title>
    <link rel="stylesheet" href="{{ public_path('css/etiqueta.css') }}">
</head>
<body>
@for ($i = 1; $i <= $cantidad; $i++)
    <div class="etiqueta" style="{{ $i < $cantidad ? 'page-break-after: always;' : '' }}">
        <div class="contenido">

            {{-- Espacio reservado para logo --}}
            <div class="espacio-logo"></div>

            <div class="campos">
                <div>CLIENTE: {{ $envio->nombre_cliente }}</div>

                <div>
                    PEDIDO:
                    <span class="{{ $envio->pedido === 'INCIDENCIA' ? 'incidencia' : '' }}">
                        {{ $envio->pedido }}
                    </span>
                </div>

                <div>ZONA: {{ $envio->zona }}</div>

                @if(!empty($envio->destinatario))
                    <div>DESTINATARIO: {{ $envio->destinatario }}</div>
                @endif

                @if($envio->usar_palets)
                    <div>BULTOS: {{ $envio->bultos ?? '-' }}</div>
                    <div>PALET: {{ $i }}/{{ $cantidad }}</div>
                @else
                    <div>BULTOS: {{ $i }}/{{ $cantidad }}</div>
                @endif
            </div>

        </div>
    </div>
@endfor
</body>
</html>
