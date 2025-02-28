<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $fillable = ['kelas_id', 'guru_id', 'pelajaran_id', 'hari', 'jam_mulai', 'jam_selesai'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    // Perbaiki relasi ke User dengan menentukan foreign key 'guru_id'
    public function user()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class);
    }
}
