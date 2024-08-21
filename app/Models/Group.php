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
        'guestId',
    ];

    // Tentukan atribut yang tidak boleh diisi mass-assign
    protected $guarded = [];

    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guestId', 'id');
    }
}
