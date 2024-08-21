<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'parent',
        'thumbnail',
        'price',
        'discount',
        'published',
        'content',
        'color',
        'music',
        'meta',
    ];

    protected $guarded = [];

    protected $casts = [
        'content' => 'array',
        'color' => 'array',
        'meta' => 'array',
    ];

    public function invitations()
    {
        return $this->hasMany(Invitation::class, 'templateId', 'id');
    }
}
