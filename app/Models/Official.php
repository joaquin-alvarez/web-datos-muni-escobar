<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Official extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'position', 'rank', 'area',
        'biography', 'photo_url', 'cv_url', 'email', 'phone',
        'is_intendente', 'is_cabinet', 'sort_order'
    ];

    protected $casts = [
        'is_intendente' => 'boolean',
        'is_cabinet' => 'boolean',
    ];

    public function scopeIntendente($query)
    {
        return $query->where('is_intendente', true);
    }

    public function scopeCabinet($query)
    {
        return $query->where('is_cabinet', true)->orderBy('sort_order');
    }

    public function scopeByArea($query, $area = null)
    {
        if ($area) {
            return $query->where('area', $area);
        }
        return $query;
    }
}
