<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Residence;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function show_type(string $type, Residence $residence)
    {
        $types = ["Compte rendu", "Facture et devis", "Autres"];

        if ($type=="tous") {
            $documents = Document::where('residence_id', $residence->id)
            ->get();

        return view('document.document')->with([
            'residence' => $residence,
            'types' => $types,
            'documents' => $documents
        ]);
        }

        // Fetch documents for the selected residence and type
        $documents = Document::where('residence_id', $residence->id)
            ->where('type', $type)
            ->get();

        return view('document.document')->with([
            'residence' => $residence,
            'types' => $types,
            'documents' => $documents
        ]);
    }


    public function index(Request $request):View{

        $user = Auth::user();
        $types = ["Compte rendu","Facture et devis","Autres" ];
        if ($user->residence) {
            $residence = $user->residence;

            return view("document.document")->with(["residence"=>$residence , "types"=>$types , "documents"=>$residence->documents]);
        }else if($user->hasRole('admin|superadmin')){
            $residence = Residence::first();
            return view("document.document")->with(["residence"=>$residence, "types"=>$types, "documents"=>$residence->documents]);
        }
        return  view("document.document");

    }

    public function getDocument(Residence $residence):View{
        $types = ["Compte rendu","Facture et devis","Autres" ];

        return view("document.document")->with(["residence"=>$residence, "types"=>$types, "documents"=>$residence->documents]);

    }


    public function store(Request $request){

        $validateData = $request->validate([
            "type"=> "required",
            "titre"=> "required|string",
            "fichier"=>"required|file|max:2048", // Max file size is 2MB
            "commentaire"=>"nullable|string",
            "residence_id" => "required|exists:residences,id"
        ]);

        if($request->hasFile("fichier")){
            $file = $request->file("fichier");
            $validateData['fichier'] = $file->store("documents","public");

        }

        Document::create($validateData);
        return redirect()->back();


    }








}
