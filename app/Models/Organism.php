<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organism extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'type', 'description', 'functions',
        'address', 'phone', 'email',
        'parent_id', 'head_name', 'head_position', 'sort_order'
    ];

    public function parent()
    {
        return $this->belongsTo(Organism::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Organism::class, 'parent_id')->orderBy('sort_order');
    }
}
