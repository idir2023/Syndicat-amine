<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReglageController extends Controller
{
    public function index()
    {
        return view('reglages.index'); // Assurez-vous que le chemin de la vue est correct
    }
}

