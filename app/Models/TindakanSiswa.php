<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TindakanSiswa extends Model
{
    protected $table = 'tindakan_siswa';
    protected $fillable = ['catatan', 'status', 'tanggal', 'id_siswa', 'id_tindakan'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function kategoriTindakan()
    {
        return $this->belongsTo(KategoriTindakan::class, 'id_tindakan');
    }
}
