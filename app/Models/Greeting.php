<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Greeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'message',
        'template_id',
    ];

    public function scopeOwned($query, $id)
    {
        $query->where('template_id', $id);
    }
}
