<?php

// app/Http/Controllers/SearchController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // Lakukan logika pencarian atau tindakan lainnya di sini
        $query = $request->input('query');
        // Contoh:
        return view('search.results', ['query' => $query]);
    }
}
