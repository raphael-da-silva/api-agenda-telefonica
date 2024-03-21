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

    public function post(Request $request): JsonResponse
    {
        $input = $request->json()->all();
        $name  = $request->json('name');

        $this->validateInput($request)->validate();
        $agenda = AgendaModel::create($input);

        return response()->json([
            'created' => ($agenda != null) ? ucfirst($name) . ' foi colocado na agenda.' : 'Não foi possivel salvar.'
        ], 201);
    }

    private function validateInput(Request $request, int $id = null)
    {
        return Validator::make($request->json()->all(), [
            'name'  => 'required',
            'email' => 'required|email|unique:agenda,email,' . $id,
            'birth' => 'required|date',
            'cpf'   => 'required|digits:11|unique:agenda,cpf,' . $id,
            'phone' => 'required|min:8'
        ],[
            'name' => 'O nome do usuário é obrigatório',
            'email' => [
                'required' => 'O e-mail do usuario é obrigatório',
                'unique'   => 'Este e-mail já esta sendo usado.',
                'email'    => 'O e-mail é invalido'
            ],
            'birth' => [
                'required' => 'Data de nascimento é obrigatória',
                'date'     => 'A data informada é inválida'
            ],
            'cpf' => [
                'required' => 'CPF é obrigatório',
                'unique'   => 'Este CPF já esta sendo usado.',
                'digits'   => 'CPF não tem o número de digitos esperados'
            ],
            'phone' => [
                'required' => 'Número de telefone é obrigatório',
                'min'      => 'O número deve ter no minimo 8 digitos'
            ],
        ]);
    }

    public function update(Request $request, int $id): JsonResponse
    {   
        $agenda = AgendaModel::find($id);

        if(!$agenda){
            throw new NotFoundHttpException('O registro não existe não existe.');
        }

        $this->validateInput($request, $id)->validate();

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
