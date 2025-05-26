<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasSiswa extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan
     */
    protected $table = 'kelas_siswa';

    /**
     * Kolom yang dapat diisi massal
     */
    protected $fillable = [
        'id_siswa',
        'id_kelas',
        'status',
        'is_active',
        'tahun_ajaran'
    ];

    /**
     * Kolom yang harus di-cast
     */
    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Relasi ke model Siswa
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    /**
     * Relasi ke model Kelas
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    /**
     * Scope untuk filter status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}