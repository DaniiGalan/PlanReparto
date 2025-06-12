<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 4px; text-align: left; }
    </style>
</head>
<body>
    <h1>Listado de Reparto – Zona {{ $listado->zona }}</h1>
    <p>Fecha: {{ $listado->fecha->format('d/m/Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Pedido</th>
                <th>Zona</th>
                <th>Destinatario</th>
                <th>Bultos</th>
                <th>Palets</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listado->envios as $envio)
                <tr>
                    <td>{{ $envio->nombre_cliente }}</td>
                    <td>{{ $envio->direccion }}</td>
                    <td>{{ $envio->zona }}</td>
                    <td>{{ $envio->nombre_cliente }}</td>
                    <td>{{ $envio->bultos ?? '-' }}</td>
                    <td>{{ $envio->palets ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
