<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    // Tentukan atribut yang boleh diisi mass-assign
    protected $fillable = [
        'title',
        'slug',
        'parent',
        'thumbnail',
        'price',
        'discount',
        'category',
        'content',
        'color',
        'music',
        'meta',
        'published',
    ];

    // Tentukan atribut yang tidak boleh diisi mass-assign
    protected $guarded = [];

    protected $casts = [
        'content' => 'array',
        'color' => 'array',
        'meta' => 'json',
    ];

    public function invitations()
    {
        return $this->hasMany(Invitation::class, 'templateId', 'id');
    }
}
