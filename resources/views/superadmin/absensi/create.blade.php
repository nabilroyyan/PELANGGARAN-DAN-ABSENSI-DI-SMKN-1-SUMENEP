@extends('layout.MainLayout')

@section('content')
<div class="container">
    <h4>Input Absensi Hari Ini - {{ \Carbon\Carbon::parse($tanggalHariIni)->format('d M Y') }}</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($siswaBelumAbsen->isEmpty())
        <div class="alert alert-info">Semua siswa sudah diabsen hari ini.</div>
    @else
        <form action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Status</th>
                        <th>Catatan</th>
                        <th>Foto Surat (Jika Sakit/Izin)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswaBelumAbsen as $i => $data)
                        <tr>
                            <td>{{ $data->siswa->nama_siswa }}</td>
                            <td>
                                <select name="absensi[{{ $i }}][status]" class="form-control" required>
                                    <option value="hadir">Hadir</option>
                                    <option value="sakit">Sakit</option>
                                    <option value="izin">Izin</option>
                                    <option value="alpa">Alpa</option>
                                </select>
                                <input type="hidden" name="absensi[{{ $i }}][kelas_siswa_id]" value="{{ $data->id }}">
                            </td>
                            <td>
                                <input type="text" name="absensi[{{ $i }}][catatan]" class="form-control">
                            </td>
                            <td>
                                <input type="file" name="absensi[{{ $i }}][foto_surat]" class="form-control-file">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Simpan Absensi</button>
        </form>
    @endif
</div>
@endsection
