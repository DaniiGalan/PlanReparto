<?php

namespace App\Http\Controllers;

use App\Models\Envio;
use App\Models\Listado;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class EnvioController extends Controller
{
    public function index()
    {
        $envios = Envio::latest()->paginate(20);
        return view('envios.index', compact('envios'));
    }

    public function create()
    {
        // Zonas predefinidas
        $zonas = ['NORTE', 'SUR', 'GRAN CANARIA', 'RHENUS', 'TENEPALMA', 'CLI'];
        return view('envios.create', compact('zonas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'zona' => 'required|string',
            'nombre_cliente' => 'required|string',
            'pedido' => 'required|string',
            'direccion' => 'nullable|string',
            'destinatario' => 'nullable|string',
            'bultos' => 'nullable|integer|min:1',
            'palets' => 'nullable|integer|min:1',
        ]);

        $envio = Envio::create([
            'zona' => $request->zona,
            'nombre_cliente' => $request->nombre_cliente,
            'direccion' => $request->pedido,
            'etiqueta_pdf' => null,
            'enlistado' => false,
            'bultos' => $request->bultos,
            'palets' => $request->usar_palets ? $request->palets : null,
        ]);

        return redirect()->route('envios.etiqueta', $envio->id);
    }

    public function etiqueta($id)
    {
        $envio = Envio::findOrFail($id);

        $cantidad = $envio->palets && $envio->palets > 0 ? $envio->palets : ($envio->bultos ?? 1);

        $pdf = Pdf::loadView('envios.etiqueta', compact('envio', 'cantidad'))
            ->setPaper([0, 0, 283.46, 283.46], 'portrait'); // 100x100 mm

        return $pdf->stream('etiquetas_envio_' . $envio->id . '.pdf');
    }
}
