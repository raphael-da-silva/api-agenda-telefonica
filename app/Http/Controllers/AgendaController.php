<?php

namespace App\Http\Controllers;

use App\Models\AgendaModel;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

// Teste - Raphael da Silva
class AgendaController extends Controller
{
    public function __construct()
    {}

    private function validateInput(Request $request, int $id = null): void
    {
        $validator = Validator::make($request->json()->all(), [
            'name'  => 'required',
            'email' => 'required|email|unique:agenda,email,' . $id,
            'birth' => 'required|date_format:Y-m-d',
            'cpf'   => 'required|digits:11|unique:agenda,cpf,' . $id,
            'phone' => 'required|numeric|digits_between:8,9'
        ], AgendaModel::getValidationMessages());

        if($validator->fails()){
            $this->throwValidationException($request, $validator);
        }
    }

    public function post(Request $request): JsonResponse
    {
        $input = $request->json()->all();
        $name  = $request->json('name');

        $this->validateInput($request);
        $agenda = AgendaModel::create($input);

        return response()->json([
            'created' => ($agenda != null) ? ucfirst($name) . ' foi colocado na agenda.' : 'Não foi possivel salvar.'
        ], 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {   
        $agenda = AgendaModel::find($id);

        if(!$agenda){
            throw new NotFoundHttpException('O registro não existe não existe.');
        }

        $this->validateInput($request, $id);

        $agenda->name  = $request->json('name');
        $agenda->email = $request->json('email');
        $agenda->birth = $request->json('birth');
        $agenda->cpf   = $request->json('cpf');
        $agenda->phone = $request->json('phone');

        $updated = $agenda->save();

        return response()->json([
            'updated' => $updated ? 'Dados atualizados!' : 'Não foi possivel atualizar.'
        ]);
    }

    public function delete(string $name): JsonResponse
    {
        $name   = urldecode($name);
        $agenda = AgendaModel::where('name', $name)->first();

        if(!$agenda){
            throw new NotFoundHttpException('Este nome não existe na agenda.');
        }

        $delete = $agenda->delete();

        return response()->json([
            'deleted' => $delete ? sprintf('%s foi deletado.', $name) : 'Não foi possivel deletar.'
        ]);
    }
}
