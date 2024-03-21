<?php

namespace App\Http\Controllers;

use App\Models\AgendaModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

// Teste - Raphael da Silva
class AgendaController extends Controller
{
    public function __construct()
    {}

    public function post(Request $request): JsonResponse
    {
        $input  = $request->json()->all();
        $name   = $request->json('name');
        $agenda = AgendaModel::create($input);

        return response()->json([
            'created' => ($agenda != null) ? ucfirst($name) . ' foi colocado na agenda' : 'Não foi possivel salvar'
        ], 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {   
        $input  = $request->json()->all();
        $agenda = AgendaModel::find($id);

        if(!$agenda){
            throw new NotFoundHttpException('Agenda não existe');
        }

        $agenda->name  = $request->json('name');
        $agenda->email = $request->json('email');
        $agenda->birth = $request->json('birth');
        $agenda->cpf   = $request->json('cpf');
        $agenda->phone = $request->json('phone');

        $updated = $agenda->save();

        return response()->json([
            'updated' => $updated ? 'Dados atualizados!' : 'Não foi possivel atualizar'
        ]);
    }

    public function delete(Request $request, string $name): JsonResponse
    {
        $agenda = AgendaModel::where('name', $name)->first();

        if(!$agenda){
            throw new NotFoundHttpException('Agenda não existe');
        }

        $delete = $agenda->delete();

        return response()->json([
            'deleted' => $delete ? sprintf('%s foi deletado.', $name) : 'Não foi possivel deletar'
        ]);
    }
}
