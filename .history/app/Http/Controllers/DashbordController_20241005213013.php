<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashbordController extends Controller
{
    public function index()
    {
        return view('dashboard.index'); // Assurez-vous que le chemin de la vue est correct
    }
    public function dashboard()
{
    $user = Auth::user();
    
    // Récupérer la résidence de l'utilisateur
    $residenceId = $user->residence_id;

    // Récupérer les statistiques par rôle dans cette résidence
    $superManagerCount = User::where('role', 'Super Manager')->where('residence_id', $residenceId)->count();
    $managerCount = User::where('role', 'Manager')->where('residence_id', $residenceId)->count();
    $proprietaireCount = User::where('role', 'Propriétaire')->where('residence_id', $residenceId)->count();
    $residentCount = User::where('role', 'Résident')->where('residence_id', $residenceId)->count();
    $adminCount = User::where('role', 'Admin')->where('residence_id', $residenceId)->count();
    $residenceCount = Residence::where('id', $residenceId)->count();

    return view('dashboard.index', compact('superManagerCount', 'managerCount', 'proprietaireCount', 'residentCount', 'adminCount', 'residenceCount'));
}

}