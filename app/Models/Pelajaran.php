<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelajaran extends Model
{
    use HasFactory;

    protected $table = 'pelajaran';
    protected $fillable = ['nama', 'deskripsi'];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function materis()
    {
        return $this->hasMany(Materi::class);
    }
}
