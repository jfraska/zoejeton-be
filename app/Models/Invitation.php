<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari konvensi penamaan
    protected $table = 'invitations';

    // Tentukan primary key jika berbeda dari konvensi penamaan
    protected $primaryKey = 'id';

    // Jenis primary key
    protected $keyType = 'string';

    // Apakah primary key auto-increment (tidak berlaku untuk string)
    public $incrementing = false;

    // Tentukan atribut yang boleh diisi mass-assign
    protected $fillable = [
        'id',
        'title',
        'subdomain',
        'userId',
        'templateId',
    ];

    // Tentukan atribut yang tidak boleh diisi mass-assign
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
