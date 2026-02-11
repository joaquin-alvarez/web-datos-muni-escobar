<?php

namespace App\Http\Controllers;

use App\Models\GlossaryTerm;
use Illuminate\Http\Request;

class GlossaryController extends Controller
{
    public function index(Request $request)
    {
        $letter = $request->get('letter');

        $query = GlossaryTerm::orderBy('term');

        if ($letter) {
            $query->where('letter', mb_strtoupper($letter));
        }

        $terms = $query->get();
        $letters = GlossaryTerm::selectRaw('DISTINCT letter')->orderBy('letter')->pluck('letter');

        return view('glossary.index', compact('terms', 'letters', 'letter'));
    }
}
