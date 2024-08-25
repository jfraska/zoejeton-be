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
        'invitation_id',
        'group_id',
        'code',
        'name',
        'status',
        'sosmed',
        'attended',
    ];

    public function scopeOwnedByInvitation($query, $id)
    {
        $query->where('invitation_id', $id);
    }

    protected $guarded = [];

    protected $casts = [
        'sosmed' => 'array',
        'attended' => 'array',
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
