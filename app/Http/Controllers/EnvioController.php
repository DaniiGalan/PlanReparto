<?php

namespace App\Http\Controllers;

use App\Models\Envio;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class EnvioController extends Controller
{
    public function index()
    {
        $envios = Envio::latest()->paginate(20);
        return view('envios.index', compact('envios'));
    }

    public function create()
    {
        return view('envios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'zona' => 'required|in:NOR,SUR,GC,RHE,TEN,CLI',
            'nombre_cliente' => 'required|string|max:27',
            'pedido' => ['required', 'regex:/^(P\d{7}|INCIDENCIA)$/'],
            'destinatario' => $request->activar_destinatario ? 'required|string|max:27' : 'nullable|string|max:27',
            'bultos' => 'required|integer|min:1',
            'palets' => $request->has('usar_palets') ? 'required|integer|min:1' : 'nullable|integer',
        ]);

        $envio = Envio::create([
            'zona' => $request->zona,
            'nombre_cliente' => $request->nombre_cliente,
            'pedido' => $request->pedido,
            'destinatario' => $request->activar_destinatario ? $request->destinatario : null,
            'etiqueta_pdf' => null,
            'enlistado' => false,
            'bultos' => $request->bultos,
            'palets' => $request->has('usar_palets') ? $request->palets : null,
            'usar_palets' => $request->has('usar_palets'),
        ]);

        return redirect()->route('envios.etiqueta', $envio->id);
    }

    public function etiqueta($id)
    {
        $envio = Envio::findOrFail($id);

        $cantidad = $envio->usar_palets && $envio->palets > 0
            ? $envio->palets
            : ($envio->bultos ?? 1);

        $pdf = Pdf::loadView('envios.etiqueta', compact('envio', 'cantidad'))
            ->setPaper([0, 0, 283.5, 283.5], 'portrait');

        $fileName = 'etiquetas_envio_' . $envio->id . '.pdf';
        Storage::disk('local')->put('etiquetas/' . $fileName, $pdf->output());

        return $pdf->stream($fileName);
    }
}
