<?php

namespace App\Models;

use Abbasudo\Purity\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'name',
        'description',
        'type',
        'schedule',
    ];

    protected $guarded = [];
}
