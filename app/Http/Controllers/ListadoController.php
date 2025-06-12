<?php

namespace App\Http\Controllers;

use App\Models\Listado;
use App\Models\Envio;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ListadoController extends Controller
{
    public function create()
    {
        $envios = Envio::where('enlistado', false)->get();
        return view('listados.create', compact('envios'));
    }

    public function store(Request $request)
    {
        $enviosSeleccionados = $request->input('envios', []);

        if (count($enviosSeleccionados) === 0) {
            return back()->with('error', 'Debes seleccionar al menos un envío.');
        }

        $listado = Listado::create([
            'zona' => $request->zona,
            'fecha' => now(),
        ]);

        Envio::whereIn('id', $enviosSeleccionados)->update([
            'enlistado' => true,
            'listado_id' => $listado->id,
        ]);

        $listado->load('envios');

        $pdf = Pdf::loadView('listados.pdf', compact('listado'));
        $pdfPath = "listados/listado_{$listado->id}.pdf";
        Storage::put($pdfPath, $pdf->output());

        $listado->update(['pdf_path' => $pdfPath]);

        return redirect()->route('listados.index')->with('success', 'Listado creado y archivado correctamente.');
    }

    public function index()
    {
        $listados = Listado::withCount('envios')->orderByDesc('fecha')->get();
        return view('listados.index', compact('listados'));
    }

    public function descargar($id)
    {
        $listado = Listado::findOrFail($id);

        if (!$listado->pdf_path || !Storage::exists($listado->pdf_path)) {
            abort(404, 'PDF no encontrado.');
        }

        return response()->file(storage_path("app/" . $listado->pdf_path));
    }
}
