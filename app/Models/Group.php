<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'schedule',
    ];

    // Tentukan atribut yang tidak boleh diisi mass-assign
    protected $guarded = [];
}
