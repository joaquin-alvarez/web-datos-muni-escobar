<?php

namespace App\Http\Controllers;

use App\Models\Official;
use App\Models\Organism;
use App\Models\GovernmentArea;
use Illuminate\Http\Request;

class GovernmentController extends Controller
{
    public function authorities()
    {
        $intendente = Official::intendente()->first();
        $cabinet = Official::cabinet()->get();

        return view('government.authorities', compact('intendente', 'cabinet'));
    }

    public function officials()
    {
        $officials = Official::orderBy('sort_order')->get();
        $areas = $officials->pluck('area')->unique()->values();

        return view('government.officials', compact('officials', 'areas'));
    }

    public function organisms()
    {
        $organisms = Organism::with('children')->whereNull('parent_id')->orderBy('sort_order')->get();

        return view('government.organisms', compact('organisms'));
    }

    public function contact()
    {
        $areas = GovernmentArea::orderBy('sort_order')->get();

        return view('government.contact', compact('areas'));
    }
}
