<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'invitation_id',
        'guest',
        'whatsapp',
        'media',
        'guestbook',
        'templates',
        'fitur_premiun',
        'custom_domain',
    ];

    protected $guarded = [];

    protected $casts = [
        'templates' => 'array',
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
