<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function __invoke(Request $request)
    {
        $locale = $request->input('locale');

        if (in_array($locale, ['en', 'ar', 'fr', 'es', 'de', 'it'])) {
            Session::put('locale', $locale);
            App::setLocale($locale);
        }

        return redirect()->back();
    }
    public function change(Request $request)
    {
        $locale = $request->input('locale');

        // Store the selected locale in the session
        Session::put('locale', $locale);

        // Change the application locale
        App::setLocale($locale);

        // Redirect back to the previous page or a specific route
        return redirect()->back();
    }

    function importLang(Request $request) {
        $request->validate([
            'lang_file' => 'required|file|mimes:json',
        ]);
        $file = $request->file('lang_file');
        $locale = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $file->move(resource_path('lang'), $locale . '.json');
        session(['locale' => $locale]);
        return redirect()->back()->with('success', 'Language file imported and language switched to ' . $locale);
    }
}
