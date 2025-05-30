<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\KelasSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    // Menampilkan form input absensi hari ini
    public function create()
    {
        $userId = Auth::id();

        // Cek kelas aktif yang dipegang user ini
        $kelas = Kelas::where('id_users', $userId)
                      ->where('stt', 'aktif')
                      ->first();

        if (!$kelas) {
            return redirect()->back()->with('error', 'Anda bukan wali kelas aktif.');
        }

        $tanggalHariIni = Carbon::today()->toDateString();

        // Ambil siswa di kelas ini yang belum diabsen hari ini
        $siswaBelumAbsen = KelasSiswa::with('siswa')
            ->where('id_kelas', $kelas->id)
            ->whereDoesntHave('absensi', function ($query) use ($tanggalHariIni) {
                $query->where('hari_tanggal', $tanggalHariIni);
            })
            ->get();

        return view('superadmin.absensi.create', compact('siswaBelumAbsen', 'tanggalHariIni'));
    }

    // Menyimpan data absensi
    public function store(Request $request)
{
    $request->validate([
        'absensi.*.kelas_siswa_id' => 'required|exists:kelas_siswa,id',
        'absensi.*.status' => 'required|in:hadir,sakit,izin,alpa',
        'absensi.*.catatan' => 'nullable|string',
        'absensi.*.foto_surat' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    // Validasi tambahan: jika status sakit/izin, foto wajib
    foreach ($request->absensi as $index => $data) {
        if (in_array($data['status'], ['sakit', 'izin']) && empty($data['foto_surat'])) {
            return back()->withErrors([
                "absensi.$index.foto_surat" => "Foto surat wajib diunggah jika status sakit atau izin."
            ])->withInput();
        }
    }

    $userId = Auth::id();
    $tanggalHariIni = Carbon::today()->toDateString();

    foreach ($request->absensi as $data) {
        $kelasSiswa = KelasSiswa::findOrFail($data['kelas_siswa_id']);

        $absen = new Absensi();
        $absen->status = $data['status'];
        $absen->hari_tanggal = $tanggalHariIni;
        $absen->status_surat = in_array($data['status'], ['sakit', 'izin']) ? 'terundur' : 'diterima';
        $absen->catatan = $data['catatan'] ?? null;
        $absen->id_siswa = $kelasSiswa->id_siswa;
        $absen->kelas_siswa_id = $kelasSiswa->id;
        $absen->id_users = $userId;

        if (isset($data['foto_surat'])) {
            $path = $data['foto_surat']->store('surat', 'public');
            $absen->foto_surat = $path;
        }

        $absen->save();
    }

    return redirect()->route('absensi.create')->with('success', 'Absensi berhasil disimpan.');
}


    // Riwayat absensi hari ini
    public function riwayatHariIni()
    {
        $userId = Auth::id();
        $tanggalHariIni = Carbon::today()->toDateString();

        $kelas = Kelas::where('id_users', $userId)->where('stt', 'aktif')->first();

        if (!$kelas) {
            return redirect()->back()->with('error', 'Anda bukan wali kelas aktif.');
        }

        $riwayat = Absensi::with('siswa')
            ->where('hari_tanggal', $tanggalHariIni)
            ->where('id_users', $userId)
            ->whereHas('kelasSiswa', function ($q) use ($kelas) {
                $q->where('id_kelas', $kelas->id);
            })
            ->get();

        return view('superadmin.absensi.riwayat', compact('riwayat', 'tanggalHariIni'));
    }
}
