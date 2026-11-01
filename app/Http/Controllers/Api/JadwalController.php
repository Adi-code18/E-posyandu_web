<?php

namespace App\Http\Controllers\Api;

use App\Models\JadwalPosyandu;
use App\Models\Kader;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JadwalController extends BaseApiController
{
    /**
     * Menampilkan daftar jadwal kegiatan Posyandu.
     */
    public function index(Request $request): JsonResponse
    {
        $query = JadwalPosyandu::with(['kader', 'balita']);

        if ($request->filled('status')) {
            $query->where('status_pelaksanaan', $request->status);
        }

        $jadwal = $query->orderBy('tanggal_pelaksanaan', 'asc')->get();

        return $this->sendResponse($jadwal, 'Daftar jadwal kegiatan berhasil diambil.');
    }

    /**
     * Menampilkan detail jadwal tertentu.
     */
    public function show(int $id): JsonResponse
    {
        $jadwal = JadwalPosyandu::with(['kader', 'balita'])->find($id);

        if (!$jadwal) {
            return $this->sendError('Jadwal kegiatan tidak ditemukan.', [], 404);
        }

        return $this->sendResponse($jadwal, 'Detail jadwal berhasil diambil.');
    }

    /**
     * Membuat jadwal baru dari aplikasi mobile.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'tanggal_pelaksanaan'  => 'required|date',
            'kegiatan_pelaksanaan' => 'required|string',
            'id_kader'             => 'nullable|exists:kader,id_kader',
        ], [
            'tanggal_pelaksanaan.required'  => 'Tanggal pelaksanaan wajib ditentukan.',
            'kegiatan_pelaksanaan.required' => 'Deskripsi kegiatan pelaksanaan wajib diisi.',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi pembuatan jadwal gagal.', $validator->errors()->all(), 422);
        }

        $kader = Kader::first();

        $jadwal = JadwalPosyandu::create([
            'tanggal_pelaksanaan'  => $request->tanggal_pelaksanaan,
            'kegiatan_pelaksanaan' => $request->kegiatan_pelaksanaan,
            'status_pelaksanaan'   => 'belum',
            'id_kader'             => $request->id_kader ?? ($kader ? $kader->id_kader : null),
        ]);

        return $this->sendResponse($jadwal, 'Jadwal kegiatan baru berhasil dibuat.', 201);
    }
}

