<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari konvensi penamaan
    protected $table = 'payments';

    // Tentukan primary key jika berbeda dari konvensi penamaan
    protected $primaryKey = 'id';

    // Jenis primary key
    protected $keyType = 'string';

    // Apakah primary key auto-increment (tidak berlaku untuk string)
    public $incrementing = false;

    // Tentukan atribut yang boleh diisi mass-assign
    protected $fillable = [
        'id',
        'invitationId',
        'no',
        'name',
        'additional',
        'sosmed',
        'attended',
    ];

    // Tentukan atribut yang tidak boleh diisi mass-assign
    protected $guarded = [];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class, 'invitationId', 'id');
    }
}
