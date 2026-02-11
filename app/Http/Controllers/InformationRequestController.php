<?php

namespace App\Http\Controllers;

use App\Models\InformationRequest;
use Illuminate\Http\Request;

class InformationRequestController extends Controller
{
    public function create()
    {
        return view('information-request.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        InformationRequest::create($validated);

        return redirect()->route('information-request.create')
            ->with('success', 'Su solicitud de información ha sido enviada correctamente. Nos pondremos en contacto a la brevedad.');
    }
}
