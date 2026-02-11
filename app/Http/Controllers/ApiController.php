<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Models\Category;
use App\Models\GlossaryTerm;
use App\Models\Official;
use App\Models\Organism;
use App\Models\GovernmentArea;
use App\Http\Resources\DatasetResource;
use App\Http\Resources\DatasetCollection;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\GlossaryTermResource;
use App\Http\Resources\OfficialResource;
use App\Http\Resources\OrganismResource;
use App\Http\Resources\GovernmentAreaResource;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function datasets(Request $request)
    {
        $query = Dataset::with(['category', 'formats']);

        if ($request->has('category')) {
            $query->filterByCategory($request->category);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $sort = $request->get('sort', 'modified');
        $query->orderBySort($sort);

        $datasets = $query->paginate($request->get('per_page', 20));

        return new DatasetCollection($datasets);
    }

    public function dataset($slug)
    {
        $dataset = Dataset::with(['category', 'formats'])->where('slug', $slug)->firstOrFail();

        return new DatasetResource($dataset);
    }

    public function categories()
    {
        $categories = Category::withCount('datasets')->orderBy('name')->get();

        return CategoryResource::collection($categories);
    }

    public function glossary(Request $request)
    {
        $query = GlossaryTerm::orderBy('term');

        if ($request->has('letter')) {
            $query->where('letter', mb_strtoupper($request->letter));
        }

        $terms = $query->get();

        return GlossaryTermResource::collection($terms);
    }

    public function officials(Request $request)
    {
        $query = Official::orderBy('sort_order');

        if ($request->has('area')) {
            $query->where('area', $request->area);
        }

        if ($request->boolean('cabinet_only')) {
            $query->cabinet();
        }

        $officials = $query->get();

        return OfficialResource::collection($officials);
    }

    public function organisms()
    {
        $organisms = Organism::with('children')->whereNull('parent_id')->orderBy('sort_order')->get();

        return OrganismResource::collection($organisms);
    }

    public function governmentAreas()
    {
        $areas = GovernmentArea::orderBy('sort_order')->get();

        return GovernmentAreaResource::collection($areas);
    }
}
