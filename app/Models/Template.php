<?php

namespace App\Models;

use Abbasudo\Purity\Traits\Filterable;
use Abbasudo\Purity\Traits\Sortable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory, HasUuids, Filterable, Sortable;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'thumbnail',
        'price',
        'discount',
        'content',
        'color',
        'music',
    ];

    protected $guarded = [];

    protected $casts = [
        'content' => 'array',
        'color' => 'array',
    ];


    protected $filterFields = [
        'title',
        'category',
    ];

    private array $filters = [
        '$eq',
        '$contains',
    ];

    public function invitation()
    {
        return $this->hasMany(Invitation::class);
    }
}
