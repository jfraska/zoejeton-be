<?php

namespace App\Models;

use Abbasudo\Purity\Traits\Filterable;
use Abbasudo\Purity\Traits\Sortable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Invitation extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasUuids, Filterable, Sortable;

    protected $fillable = [
        'title',
        'subdomain',
        'userId',
        'templateId',
    ];

    protected $guarded = [];

    // Definisikan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    // Definisikan relasi dengan model Template
    public function template()
    {
        return $this->belongsTo(Template::class, 'templateId', 'id');
    }

    public function payment()
    {
        return $this->hasMany(Payment::class, 'invitationId', 'id');
    }

    public function guest()
    {
        return $this->hasMany(Guest::class, 'invitationId', 'id');
    }
}
