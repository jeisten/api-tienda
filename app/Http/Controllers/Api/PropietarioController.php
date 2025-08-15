<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Propietario;
use App\Http\Requests\PropietarioRequest;
use App\Http\Resources\PropietarioResource;
use Illuminate\Http\Request;

class PropietarioController extends Controller
{
    public function index(Request $request)
    {
        $query = Propietario::with('tiendas');
        
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('nombre', 'like', "%{$search}%")
                  ->orWhere('telefono', 'like', "%{$search}%")
                  ->orWhere('direccion', 'like', "%{$search}%");
        }

        $propietarios = $query->paginate(15);

        return PropietarioResource::collection($propietarios);
    }

    public function store(PropietarioRequest $request)
    {
        $propietario = Propietario::create($request->validated());

        return new PropietarioResource($propietario->load('tiendas'));
    }

    public function show(Propietario $propietario)
    {
        return new PropietarioResource($propietario->load('tiendas'));
    }

    public function update(PropietarioRequest $request, Propietario $propietario)
    {
        $propietario->update($request->validated());

        return new PropietarioResource($propietario->load('tiendas'));
    }

    public function destroy(Propietario $propietario)
    {
        $propietario->delete();

        return response()->json([
            'success' => true,
            'message' => 'Propietario eliminado correctamente'
        ]);
    }
}
