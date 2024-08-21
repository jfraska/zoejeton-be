<?php

namespace App\Models;

use Abbasudo\Purity\Traits\Filterable;
use Abbasudo\Purity\Traits\Sortable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory, HasUuids, Filterable, Sortable;

    protected $fillable = [
        'invitationId',
        'code',
        'name',
        'status',
        'sosmed',
        'attended',
    ];

    protected $guarded = [];

    protected $casts = [
        'sosmed' => 'array',
        'attended' => 'array',
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class, 'invitationId', 'id');
    }
}
