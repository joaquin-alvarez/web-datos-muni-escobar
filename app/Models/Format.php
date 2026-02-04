<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'extension', 'color'];

    public function datasets()
    {
        return $this->belongsToMany(Dataset::class, 'dataset_format')
                    ->withPivot('file_name', 'file_url', 'file_size')
                    ->withTimestamps();
    }
}
