<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'invitationId',
        'desc',
        'items',
        'discount',
        'total',
        'status',
    ];

    protected $guarded = [];

    protected $casts = [
        'items' => 'array',
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class, 'invitationId', 'id');
    }
}
