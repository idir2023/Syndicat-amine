<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Residence;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class ReglageController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('reglages.index')->with(["roles" => $roles]); // Assurez-vous que le chemin de la vue est correct
    }

    public function show(Residence $residence)
    {
        // // Fetch users associated with the given residence
        // // $roles = Role::all();
        // $roles = ['resident', 'manager', 'manager principal'];
        // $residence = Residence::findOrFail($residence->id);


        // if (Auth::user()->role == 'resident') {
        //     $users = User::where('residence_id', $residence->id)->get('resident');
        // } elseif (Auth::user()->role == 'manager') {
        //     $users = User::where('residence_id', $residence->id)->get('resident', 'manager');
        // } elseif (Auth::user()->role == 'manager principal') {
        //     $users = User::where('residence_id', $residence->id)->get('resident', 'manager', 'manager principal');
        // } elseif (Auth::user()->role == 'admin') {
        //     $users = User::where('residence_id', $residence->id)->get('resident', 'manager', 'manager principal', 'admin');
        // } else
        //     $users = User::where('residence_id', $residence->id)->get();
        // // dd($roles);
        // return view('reglages.index', compact('residence', 'users'))->with(["roles" => $roles]);



        // Get the current user's role
        $currentUserRole = Auth::user()->getRoleNames()->first();

        // Define the role hierarchy in order of authority
        $roleHierarchy = [
            'resident' => 1,
            'proprietaire' => 2,
            'manager' => 3,
            'manager principal' => 4,
            'admin' => 5,
            'superadmin' => 6
        ];

        // Get the current user's role level
        $currentUserRoleLevel = $roleHierarchy[$currentUserRole] ?? 0;

        if ($currentUserRoleLevel >= 5) {
            $rolesBelowCurrentUserNames = ['resident', 'proprietaire', 'manager', 'manager principal'];
        } else {
            // Create a list containing only the roles below the current user's role level
            $rolesBelowCurrentUser = array_filter($roleHierarchy, function ($level) use ($currentUserRoleLevel) {
                return $level < $currentUserRoleLevel;
            });

            // Optional: Get the role names only
            $rolesBelowCurrentUserNames = array_keys($rolesBelowCurrentUser);
        }

        // print_r($rolesBelowCurrentUser);

        // Fetch users within the given residence who have a role with less than or equal authority
        $users = User::where('residence_id', $residence->id)
            ->whereHas('roles', function ($query) use ($roleHierarchy, $currentUserRoleLevel) {
                $query->whereIn('name', array_keys(array_filter($roleHierarchy, function ($level) use ($currentUserRoleLevel) {
                    return $level <= $currentUserRoleLevel;
                })));
            })
            ->get();

            // dd($residence);

        // Pass the residence, users, and roles to the view
        return view('reglages.index', compact('residence', 'users'))->with([
            'roles' => $rolesBelowCurrentUserNames // Pass the array directly
        ]);
    }
}
