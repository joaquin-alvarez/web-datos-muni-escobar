<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $totalDatasets = Dataset::count();
        $totalCategories = Category::count();
        $totalFormats = DB::table('dataset_format')->distinct('format_id')->count('format_id');

        $categories = Category::withCount('datasets')->orderBy('name')->get();

        $recentDatasets = Dataset::with(['category', 'formats'])
            ->orderBy('last_modified', 'desc')
            ->take(6)
            ->get();

        return view('home', compact(
            'totalDatasets',
            'totalCategories',
            'totalFormats',
            'categories',
            'recentDatasets'
        ));
    }
}
