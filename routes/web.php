<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BkController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\DasboardController;
use App\Http\Controllers\MonitoringPelanggaran;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\SkorPelanggaranController;
use App\Http\Controllers\KategoriTindakanController;
use App\Http\Controllers\Skor_pelanggaranController;
use App\Http\Controllers\MonitoringPelanggaranController;
use App\Http\Controllers\BkController as ControllersBkController;

    Route::middleware(['guest'])->group(function () {
        Route::get('/login', [AuthController::class, 'index'])->name('login');
        Route::post('/login_action', [AuthController::class, 'login'])->name('login.action');

    });

    Route::middleware(['auth', 'verified', 'role_permission'])->group(function () {
        Route::get('/superadmin/dashboard', [DasboardController::class, 'superadmin'])->name('superadmin');

        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::prefix('jurusan')->group(function () {
            Route::get('/', [JurusanController::class, 'index'])->name('jurusan.index');
            Route::get('/create', [JurusanController::class, 'create'])->name('jurusan.create');
            Route::post('/store', [JurusanController::class, 'store'])->name('jurusan.store');
            Route::get('/edit/{id}', [JurusanController::class, 'edit'])->name('jurusan.edit');
            Route::put('/update/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
            Route::delete('/delete/{id}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');
        });

        Route::prefix('siswa')->group(function () {
            Route::get('/', [SiswaController::class, 'index'])->name('siswa.index');
            Route::get('/create', [SiswaController::class, 'create'])->name('siswa.create');
            Route::post('/store', [SiswaController::class, 'store'])->name('siswa.store');
            Route::get('/edit/{siswa}', [SiswaController::class, 'edit'])->name('siswa.edit');
            Route::put('/{siswa}', [SiswaController::class, 'update'])->name('siswa.update');
            Route::delete('/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
            //menampilakn kelas siswa
            Route::get('/showKelasSiswa', [SiswaController::class, 'showKelasSiswa'])->name('showKelasSiswa');
            //tambah siswa ke kelas
            Route::get('/kelas/{id}/siswa', [SiswaController::class, 'showSiswa'])->name('kelas.siswa');
             Route::post('/{kelas}/siswa', [SiswaController::class, 'storeSiswa'])->name('kelas.siswa.store'); // Changed to POST
        });

       // Kelas Management
        Route::prefix('kelas')->group(function () {
            Route::get('/', [KelasController::class, 'index'])->name('kelas.index');
            Route::get('/create', [KelasController::class, 'create'])->name('kelas.create');
            Route::post('/store', [KelasController::class, 'store'])->name('kelas.store');
            Route::get('/edit/{id}', [KelasController::class, 'edit'])->name('kelas.edit');
            Route::put('/update/{id}', [KelasController::class, 'update'])->name('kelas.update');
            Route::delete('/delete/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');
            
            // detail

            Route::get('/{id}/detail-siswa', [KelasController::class, 'showSiswaByKelas'])->name('kelas.detailSiswa');

            // Naikkan siswa secara bulk (multiple)
            Route::post('/kelas/naikkan-bulk-siswa', [KelasController::class, 'naikkanBulkSiswa'])->name('kelas.naikkanBulkSiswa');
            Route::delete('/kelas/hapus-siswa/{id}', [KelasController::class, 'hapusSiswa'])->name('kelas.hapusSiswa');

        });

        Route::prefix('pelanggaran')->group(function () {
            Route::get('/', [PelanggaranController::class, 'index'])->name('pelanggaran.index');
            Route::get('/create', [PelanggaranController::class, 'create'])->name('pelanggaran.create');
            Route::post('/store', [PelanggaranController::class, 'store'])->name('pelanggaran.store');
            Route::get('/edit/{id}', [PelanggaranController::class, 'edit'])->name('pelanggaran.edit');
            Route::put('/update/{pelanggaran}', [PelanggaranController::class, 'update'])->name('pelanggaran.update');
            Route::delete('/delete/{pelanggaran}', [PelanggaranController::class, 'destroy'])->name('pelanggaran.destroy');
            // Di routes/web.php
            Route::get('/get-kelas-siswa/{id}', [PelanggaranController::class, 'getKelasSiswa']);

        });

        Route::prefix('skor-pelanggaran')->group(function () {
            Route::get('/', [SkorPelanggaranController::class, 'index'])->name('skor-Pelanggaran.index');
            Route::get('/create', [SkorPelanggaranController::class, 'create'])->name('skor-Pelanggaran.create');
            Route::post('/store', [SkorPelanggaranController::class, 'store'])->name('skor-Pelanggaran.store');
            Route::delete('/delete/{id}', [SkorPelanggaranController::class, 'destroy'])->name('skor-Pelanggaran.destroy');
        });

        Route::prefix('monitoring-pelanggaran')->group(function () {
            Route::get('/', [MonitoringPelanggaranController::class, 'index'])->name('monitoring-Pelanggaran.index');
            Route::get('/detail/{id}', [MonitoringPelanggaranController::class, 'getDetail']);
            Route::post('/tindakan', [MonitoringPelanggaranController::class, 'simpanTindakan'])->name('monitoring.tindakan');
        });

        Route::prefix('kategori-tindakan')->group(function () {
            Route::get('/', [KategoriTindakanController::class, 'index'])->name('kategori-tindakan.index');
            Route::get('/create', [KategoriTindakanController::class, 'create'])->name('kategori-tindakan.create');
            Route::post('/store', [KategoriTindakanController::class, 'store'])->name('kategori-tindakan.store');
            Route::delete('/delete/{id}', [KategoriTindakanController::class, 'destroy'])->name('kategori-tindakan.destroy');
        });

        Route::prefix('bk')->group(function () {
            Route::get('/', [BkController::class, 'index'])->name('bk.index');
            Route::post('/assign', [BkController::class, 'assign'])->name('bk.assign');
            Route::get('/unassign/{bkId}/{kelasId}', [BkController::class, 'unassign'])->name('bk.unassign');
             Route::get('/unassign-all/{bkId}', [BkController::class, 'unassignAll'])->name('bk.unassign.all');
        });


    });
