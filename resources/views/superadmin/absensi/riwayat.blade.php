@extends('layout.MainLayout')

@section('content')
<div class="container">
    <h4>Riwayat Absensi Hari Ini - {{ \Carbon\Carbon::parse($tanggalHariIni)->format('d M Y') }}</h4>

    @if($riwayat->isEmpty())
        <div class="alert alert-info">Belum ada absensi yang dicatat hari ini.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>Status</th>
                    <th>Catatan</th>
                    <th>Foto Surat</th>
                    <th>Status Surat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayat as $data)
                    <tr>
                        <td>{{ $data->siswa->nama }}</td>
                        <td>{{ ucfirst($data->status) }}</td>
                        <td>{{ $data->catatan ?? '-' }}</td>
                        <td>
                            @if($data->foto_surat)
                                <a href="{{ asset('storage/' . $data->foto_surat) }}" target="_blank">Lihat Surat</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $data->status_surat }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
