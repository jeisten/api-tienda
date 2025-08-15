<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tienda;
use App\Http\Requests\TiendaRequest;
use App\Http\Resources\TiendaResource;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    protected $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

    public function index(Request $request)
    {
        $query = Tienda::with('propietario');
        
        if ($request->has('propietario_id')) {
            $query->where('propietario_id', $request->get('propietario_id'));
        }

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('direccion_tienda', 'like', "%{$search}%")
                  ->orWhereHas('propietario', function($q) use ($search) {
                      $q->where('nombre', 'like', "%{$search}%");
                  });
        }

        if ($request->has('fecha_desde') && $request->has('fecha_hasta')) {
            $query->whereBetween('fecha_permiso', [
                $request->get('fecha_desde'),
                $request->get('fecha_hasta')
            ]);
        }

        $tiendas = $query->orderBy('created_at', 'desc')->paginate(15);

        return TiendaResource::collection($tiendas);
    }

    public function store(TiendaRequest $request)
    {
        $data = $request->validated();

        // Manejar la subida de foto
        if ($request->hasFile('foto')) {
            $data['foto_url'] = $this->imageUploadService->uploadImage(
                $request->file('foto'), 
                'tiendas/fotos'
            );
        }

        $tienda = Tienda::create($data);

        return new TiendaResource($tienda->load('propietario'));
    }

    public function show(Tienda $tienda)
    {
        return new TiendaResource($tienda->load('propietario'));
    }

    public function update(TiendaRequest $request, Tienda $tienda)
    {
        $data = $request->validated();

        // Manejar la subida de nueva foto
        if ($request->hasFile('foto')) {
            // Eliminar foto anterior si existe
            if ($tienda->foto_url) {
                $this->imageUploadService->deleteImage($tienda->foto_url);
            }
            
            $data['foto_url'] = $this->imageUploadService->uploadImage(
                $request->file('foto'), 
                'tiendas/fotos'
            );
        }

        $tienda->update($data);

        return new TiendaResource($tienda->load('propietario'));
    }

    public function destroy(Tienda $tienda)
    {
        // Eliminar foto si existe
        if ($tienda->foto_url) {
            $this->imageUploadService->deleteImage($tienda->foto_url);
        }

        $tienda->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tienda eliminada correctamente'
        ]);
    }
}
