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
}