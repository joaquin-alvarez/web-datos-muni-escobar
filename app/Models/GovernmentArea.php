<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovernmentArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'responsible_name', 'responsible_position',
        'address', 'phone', 'email', 'schedule', 'sort_order'
    ];
}
