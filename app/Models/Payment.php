<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'subscription_id',
        'desc',
        'method',
        'items',
        'discount',
        'total',
        'status',
    ];

    protected $guarded = [];

    protected $casts = [
        'items' => 'array',
    ];

    public function scopeOwnedBySubscription($query, $id)
    {
        $query->where('subscription_id', $id);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
