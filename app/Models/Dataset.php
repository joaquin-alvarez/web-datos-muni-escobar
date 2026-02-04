<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'category_id',
        'organization',
        'last_modified'
    ];

    protected $casts = [
        'last_modified' => 'datetime'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function formats()
    {
        return $this->belongsToMany(Format::class, 'dataset_format')
                    ->withPivot('file_name', 'file_url', 'file_size')
                    ->withTimestamps();
    }

    public function scopeFilterByCategory($query, $categorySlug)
    {
        if ($categorySlug) {
            return $query->whereHas('category', function($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }
        return $query;
    }

    public function scopeOrderBySort($query, $sort)
    {
        switch ($sort) {
            case 'az':
                return $query->orderBy('title', 'asc');
            case 'za':
                return $query->orderBy('title', 'desc');
            case 'modified':
            default:
                return $query->orderBy('last_modified', 'desc');
        }
    }
}
