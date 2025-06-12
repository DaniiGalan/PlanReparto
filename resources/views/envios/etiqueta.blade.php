<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        @page {
            size: 100mm 100mm;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .etiqueta {
            width: 100mm;
            height: 100mm;
            box-sizing: border-box;
            padding: 10mm;
            page-break-after: always;

            display: flex;
            flex-direction: column;
            justify-content: space-between;
            font-family: sans-serif;
        }

        .titulo {
            text-align: center;
            font-size: 16pt;
            font-weight: bold;
            color: #24408f;
        }

        .datos {
            font-size: 11pt;
            line-height: 1.4;
        }

        .dato {
            margin-bottom: 3px;
        }

        .footer {
            font-size: 10pt;
            text-align: right;
        }

        .numero {
            font-weight: bold;
            text-align: right;
            font-size: 12pt;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    @for ($i = 1; $i <= $cantidad; $i++)
        <div class="etiqueta">
            <div class="titulo">ETIQUETA DE ENVÍO</div>

            <div class="datos">
                <div class="dato"><strong>Zona:</strong> {{ $envio->zona }}</div>
                <div class="dato"><strong>Cliente:</strong> {{ $envio->nombre_cliente }}</div>
                <div class="dato"><strong>Destinatario:</strong> {{ $envio->destinatario ?? $envio->nombre_cliente }}</div>
                <div class="dato"><strong>Pedido:</strong> {{ $envio->direccion }}</div>
                <div class="dato"><strong>Bultos:</strong> {{ $envio->bultos ?? '-' }}</div>
                <div class="dato"><strong>Palets:</strong> {{ $envio->palets ?? '-' }}</div>
                <div class="dato"><strong>Fecha:</strong> {{ $envio->created_at->format('d/m/Y') }}</div>
            </div>

            <div class="numero">{{ $i }}/{{ $cantidad }}</div>
            <div class="footer">PlanReparto</div>
        </div>
    @endfor
</body>
</html>
