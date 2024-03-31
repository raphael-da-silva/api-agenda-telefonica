<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

// Teste api - Raphael da Silva
class AgendaModel extends Model
{
    protected $table = 'agenda';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 
        'email',
        'birth',
        'cpf',
        'phone'
    ];

    public static function getValidationMessages(): array
    {
        return [
            'name' => 'O nome do usuário é obrigatório.',
            'email' => [
                'required' => 'O e-mail do usuario é obrigatório.',
                'unique'   => 'Este e-mail já esta sendo usado.',
                'email'    => 'O e-mail é invalido.'
            ],
            'birth' => [
                'required' => 'Data de nascimento é obrigatória.',
                'date_format' => 'A data informada é inválida.'
            ],
            'cpf' => [
                'required' => 'CPF é obrigatório.',
                'unique'   => 'Este CPF já esta sendo usado.',
                'digits'   => 'CPF não tem o número de digitos esperados.'
            ],
            'phone' => [
                'required' => 'Número de telefone é obrigatório.',
                'numeric'  => 'O telefone deve conter apenas números.',
                'digits_between' => 'O número de telefone deve ter de 8 a 9 digitos.'
            ],
        ];
    }

    public function insertForAPI(Request $request): bool
    {
        $agenda = AgendaModel::create(
            $request->json()->all()
        );

        return ($agenda != null);
    }

    public function updateForAPI(self $agenda, Request $request): bool
    {
        $agenda->name  = $request->json('name');
        $agenda->email = $request->json('email');
        $agenda->birth = $request->json('birth');
        $agenda->cpf   = $request->json('cpf');
        $agenda->phone = $request->json('phone');

        return $agenda->save();
    }

    public function getList(): Collection
    {
        return self::all();
    }
}