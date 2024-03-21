<?php

namespace App\Http\Controllers;

use App\Models\AgendaModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

// Teste - Raphael da Silva
class AgendaController extends Controller
{
    public function __construct()
    {}

    public function post(Request $request): JsonResponse
    {
        $input = $request->json()->all();
        $name  = $request->json('name');
        $email = $request->json('email');
        
        $agenda = AgendaModel::create($input);

        dd($agenda);

        return response()->json([
            'created' => null
        ], 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        return response()->json([
            'updated' => null
        ]);
    }

    public function delete(Request $request, string $name): JsonResponse
    {
        return response()->json([
            'deleted' => null
        ]);
    }
}
