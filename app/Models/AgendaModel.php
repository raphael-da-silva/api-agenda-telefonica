<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;

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
                'numeric'  => 'O telefone deve conter apenas números.',
                'digits_between' => 'O número de telefone deve ter de 8 a 9 digitos.'
            ],
        ];
    }
}