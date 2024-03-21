<?php

namespace App\Http\Controllers;

use App\Models\AgendaModel;
use Illuminate\View\View;

// Teste - Raphael da Silva
class AgendaNamesController extends Controller
{
    public function index(): View
    {   
        $list = AgendaModel::all();

        return view('names', [
            'list' => $list
        ]);
    }
}