<?php

namespace App\Http\Controllers;

use App\Models\AgendaModel;
use Illuminate\View\View;

// Teste - Raphael da Silva
class AgendaNamesController extends Controller
{
    public function __construct(
        private AgendaModel $agendaModel
    ){}

    public function index(): View
    {
        return view('names', [
            'list' => $this->agendaModel->getList()
        ]);
    }
}