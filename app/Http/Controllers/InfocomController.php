<?php

namespace App\Http\Controllers;

use App\Models\InfoCom;
use App\Models\Residence;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InfocomController extends Controller
{

    public function index()
    {
        $infoComs = InfoCom::all();
        $users = User::all(); // Ensure the 'users' relationship is loaded if needed
    
        // Return the view with compact variables
        return view('infocom.index', compact('users', 'infoComs'));
    }      
    

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id', // Ensure user_id exists in the users table
        ]);

        // Create a new InfoCom instance and set its attributes
        $infoCom = new InfoCom();
        $infoCom->titre = $validatedData['titre'];
        $infoCom->description = $validatedData['description'];
        $infoCom->user_id = $validatedData['user_id'];
        $infoCom->date_info = Carbon::now(); // Set the current date and time for date_info

        // Save the InfoCom record to the database
        $infoCom->save();

        // Redirect to the index route with a success message
        return redirect()->route('infocom.index')->with('success', 'InfoCom added successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('infocom.index');
    }


    
}
