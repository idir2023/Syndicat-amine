<?php

namespace App\Http\Controllers;

use App\Models\Residence;
use Illuminate\View\View;
use App\Models\Inventaire;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class InventaireController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        if ($user->hasRole('admin|superadmin')) {
            $residence = Residence::first();
            $inventaires = $residence->inventaires;
        }else {
            $residence = $user->residence;
            $inventaires = $user->residence->inventaires;
        }

        return view('inventaire.index',compact('inventaires','residence'));
    }

    public function getInventaire(Residence $residence)  {
        $inventaires = $residence->inventaires;

        return view('inventaire.index',compact('inventaires','residence'));

    }


    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:100',
            'details' => 'required|string|max:500',
            'date_achat' => 'required|date',
            'date_prochain_achat' => 'required|date|after_or_equal:date_achat',
            "residence_id" => "required|exists:residences,id"
        ]);
        try {

            Inventaire::create($validatedData);
            return redirect()->back()->with('success', 'Inventaire ajouté avec succès.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout de l\'inventaire.');
        }
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'details' => 'required|string|max:500',
        ]);

        $inventaire = Inventaire::findOrFail($id);
        $inventaire->details = $validatedData['details'];
        $inventaire->save();

        return redirect()->back()->with('success', 'Details updated successfully');
    }


}
