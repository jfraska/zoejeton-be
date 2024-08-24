<?php

namespace App\Models;

use Abbasudo\Purity\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory, Filterable;

    protected $fillable = [
        'invitation_id',
        'name',
        'description',
        'type',
        'schedule',
    ];

    protected $guarded = [];

    public function scopeOwnedByInvitation($query, $id)
    {
        $query->where('invitation_id', $id);
    }
}
