<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Models\Category;
use Illuminate\Http\Request;

class DatasetController extends Controller
{
    public function index(Request $request)
    {
        $query = Dataset::with(['category', 'formats']);
        
        if ($request->has('category') && $request->category != '') {
            $query->filterByCategory($request->category);
        }
        
        $sort = $request->get('sort', 'modified');
        $query->orderBySort($sort);
        
        $datasets = $query->paginate(12);
        $categories = Category::withCount('datasets')->orderBy('name')->get();
        $totalCount = Dataset::count();
        
        return view('datasets.index', compact('datasets', 'categories', 'totalCount', 'sort'));
    }

    public function show($slug)
    {
        $dataset = Dataset::with(['category', 'formats'])->where('slug', $slug)->firstOrFail();
        
        return view('datasets.show', compact('dataset'));
    }
}
