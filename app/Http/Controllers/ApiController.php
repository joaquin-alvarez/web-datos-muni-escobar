<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Models\Category;
use App\Models\GlossaryTerm;
use App\Models\Official;
use App\Models\Organism;
use App\Models\GovernmentArea;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function datasets(Request $request)
    {
        $query = Dataset::with(['category', 'formats']);

        if ($request->has('category')) {
            $query->filterByCategory($request->category);
        }

        $sort = $request->get('sort', 'modified');
        $query->orderBySort($sort);

        $datasets = $query->paginate($request->get('per_page', 20));

        return response()->json($datasets);
    }

    public function dataset($slug)
    {
        $dataset = Dataset::with(['category', 'formats'])->where('slug', $slug)->firstOrFail();

        return response()->json($dataset);
    }

    public function categories()
    {
        $categories = Category::withCount('datasets')->orderBy('name')->get();

        return response()->json($categories);
    }

    public function glossary()
    {
        $terms = GlossaryTerm::orderBy('term')->get();

        return response()->json($terms);
    }

    public function officials()
    {
        $officials = Official::orderBy('sort_order')->get();

        return response()->json($officials);
    }

    public function organisms()
    {
        $organisms = Organism::with('children')->whereNull('parent_id')->orderBy('sort_order')->get();

        return response()->json($organisms);
    }

    public function governmentAreas()
    {
        $areas = GovernmentArea::orderBy('sort_order')->get();

        return response()->json($areas);
    }
}
