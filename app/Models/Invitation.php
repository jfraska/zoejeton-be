<?php

namespace App\Models;

use Abbasudo\Purity\Traits\Filterable;
use Abbasudo\Purity\Traits\Sortable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;

class Invitation extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasUuids, Filterable, Sortable;

    protected $fillable = [
        'title',
        'subdomain',
        'user_id',
        'template_id',
        'meta',
        'published'
    ];

    protected $guarded = [];

    protected $casts = [
        'meta' => 'array',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('templates')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, [
                    'image/jpeg',    // JPEG images
                    'image/png',     // PNG images
                    'audio/mpeg',    // MP3 audio
                    'video/mp4'      // MP4 video
                ]);
            });

        $this->addMediaCollection('thumbnail')
            ->singleFile()
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, [
                    'image/jpeg',    // JPEG images
                    'image/png',     // PNG images
                ]);
            });
    }

    public function scopeOwned($query)
    {
        $query->where('user_id', Auth::id());
    }

    public function subscription()
    {
        return $this->hasMany(Subscription::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guest()
    {
        return $this->hasMany(Guest::class);
    }
}
