<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelajaran_id',
        'kelas_id',
        'guru_id',
        'title',
        'description',
        'file_path',
        'file_type'
    ];

    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class);
    }

    public function kelas()
    {
        return $this->belongsTo(\App\Models\Kelas::class);
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}
