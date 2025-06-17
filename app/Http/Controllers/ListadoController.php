<?php

namespace App\Http\Controllers;

use App\Models\Listado;
use App\Models\Envio;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ListadoController extends Controller
{
    public function create(Request $request)
    {
        $zona = $request->input('zona', 'TODOS');
        $estado = $request->input('estado', 'no_enlistados');
        $buscar = $request->input('buscar');

        $envios = Envio::when($zona !== 'TODOS', fn($q) => $q->where('zona', $zona))
            ->when($estado === 'enlistados', fn($q) => $q->where('enlistado', true))
            ->when($estado === 'no_enlistados', fn($q) => $q->where('enlistado', false))
            ->when($buscar, function ($q) use ($buscar) {
                $q->where(function ($sub) use ($buscar) {
                    $sub->where('nombre_cliente', 'like', "%$buscar%")
                        ->orWhere('pedido', 'like', "%$buscar%");
                });
            })
            ->orderByDesc('created_at')
            ->get();

        return view('listados.create', compact('envios', 'zona', 'estado', 'buscar'));
    }

    public function store(Request $request)
    {
        $enviosSeleccionados = $request->input('envios', []);

        if (count($enviosSeleccionados) === 0) {
            return back()->with('error', 'Debes seleccionar al menos un envío.');
        }

        $zona = $request->input('zona');

        if ($zona === 'TODOS') {
            return back()->with('error', 'No se pueden crear listados mezclando zonas.');
        }

        $envios = Envio::whereIn('id', $enviosSeleccionados)->get();
        foreach ($envios as $envio) {
            if ($envio->zona !== $zona) {
                return back()->with('error', 'Todos los envíos deben pertenecer a la zona seleccionada.');
            }
        }

        $listado = Listado::create([
            'zona' => $zona,
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
