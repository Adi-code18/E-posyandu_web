<?php

namespace App\Http\Controllers\Api;

use App\Models\PemeriksaanBalita;
use App\Models\PemeriksaanBumil;
use App\Models\PemeriksaanLansia;
use App\Models\PemeriksaanRemaja;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PemeriksaanController extends BaseApiController
{
    /**
     * Input pemeriksaan tumbuh kembang balita.
     */
    public function storeBalita(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'nullable|date',
            'tb'      => 'required|numeric|min:20',
            'bb'      => 'required|numeric|min:1',
            'lk'      => 'nullable|numeric',
            'la'      => 'nullable|numeric',
            'lp'      => 'nullable|numeric',
            'status'  => 'nullable|string',
        ], [
            'tb.required' => 'Tinggi badan wajib diisi.',
            'bb.required' => 'Berat badan wajib diisi.',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi data balita gagal.', $validator->errors()->all(), 422);
        }

        $bb = (float) $request->bb;
        $status = $request->status;
        if (empty($status)) {
            $status = ($bb < 8.0) ? 'Perlu Pemantauan Gizi' : 'Gizi Baik (Normal)';
        }

        $user = User::first();

        $data = PemeriksaanBalita::create([
            'tanggal' => $request->input('tanggal', now()->toDateString()),
            'bb'      => $bb,
            'tb'      => $request->tb,
            'lk'      => $request->lk,
            'la'      => $request->la,
            'lp'      => $request->lp,
            'status'  => $status,
            'id_user' => $user ? $user->id_user : null,
        ]);

        return $this->sendResponse($data, 'Pemeriksaan balita berhasil disimpan.', 201);
    }

    /**
     * Input pemeriksaan ibu hamil (ANC).
     */
    public function storeBumil(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'tanggal'        => 'nullable|date',
            'usia_kehamilan' => 'required|string',
            'bb'             => 'required|numeric|min:30',
            'tb'             => 'nullable|numeric',
            'la'             => 'nullable|numeric', // Lingkar lengan atas
            'lp'             => 'nullable|numeric',
            'tensi'          => 'required|string',
            'status'         => 'nullable|string',
        ], [
            'usia_kehamilan.required' => 'Usia kehamilan wajib diisi.',
            'bb.required'             => 'Berat badan ibu hamil wajib diisi.',
            'tensi.required'          => 'Tekanan darah (tensi) wajib diisi.',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi data ibu hamil gagal.', $validator->errors()->all(), 422);
        }

        $la = (float) $request->input('la', 0);
        $status = $request->status;
        if (empty($status)) {
            $status = ($la > 0 && $la < 23.5) ? 'Risiko KEK (Kurang Energi Kronis)' : 'Sehat & Normal';
        }

        $user = User::first();

        $data = PemeriksaanBumil::create([
            'tanggal'        => $request->input('tanggal', now()->toDateString()),
            'usia_kehamilan' => $request->usia_kehamilan,
            'bb'             => $request->bb,
            'tb'             => $request->tb,
            'la'             => $request->la,
            'lp'             => $request->lp,
            'tensi'          => $request->tensi,
            'status'         => $status,
            'id_user'        => $user ? $user->id_user : null,
        ]);

        return $this->sendResponse($data, 'Pemeriksaan ibu hamil berhasil dicatat.', 201);
    }

    /**
     * Input pemeriksaan kesehatan remaja.
     */
    public function storeRemaja(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'tanggal'    => 'nullable|date',
            'bb'         => 'required|numeric',
            'tb'         => 'required|numeric',
            'tensi'      => 'nullable|string',
            'hemoglobin' => 'required|numeric',
            'gula'       => 'nullable|numeric',
            'status'     => 'nullable|string',
        ], [
            'bb.required'         => 'Berat badan remaja wajib diisi.',
            'tb.required'         => 'Tinggi badan remaja wajib diisi.',
            'hemoglobin.required' => 'Kadar Hemoglobin (Hb) wajib diisi.',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi data remaja gagal.', $validator->errors()->all(), 422);
        }

        $hb = (float) $request->hemoglobin;
        $status = $request->status;
        if (empty($status)) {
            $status = ($hb < 12.0) ? 'Anemia Ringan (Perlu TTD)' : 'Normal / Bebas Anemia';
        }

        $user = User::first();

        $data = PemeriksaanRemaja::create([
            'tanggal'    => $request->input('tanggal', now()->toDateString()),
            'bb'         => $request->bb,
            'tb'         => $request->tb,
            'tensi'      => $request->tensi,
            'hemoglobin' => $hb,
            'gula'       => $request->gula,
            'status'     => $status,
            'id_user'    => $user ? $user->id_user : null,
        ]);

        return $this->sendResponse($data, 'Skrining kesehatan remaja berhasil dicatat.', 201);
    }

    /**
     * Input pemeriksaan lansia (PTM).
     */
    public function storeLansia(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'tanggal'          => 'nullable|date',
            'bb'               => 'required|numeric',
            'tb'               => 'nullable|numeric',
            'tensi'            => 'required|string',
            'gula'             => 'nullable|numeric',
            'riwayat_penyakit' => 'nullable|string',
            'status'           => 'nullable|string',
        ], [
            'tensi.required' => 'Tekanan darah lansia wajib diisi.',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi data lansia gagal.', $validator->errors()->all(), 422);
        }

        $user = User::first();

        $data = PemeriksaanLansia::create([
            'tanggal'          => $request->input('tanggal', now()->toDateString()),
            'bb'               => $request->bb,
            'tb'               => $request->tb,
            'tensi'            => $request->tensi,
            'gula'             => $request->gula,
            'riwayat_penyakit' => $request->riwayat_penyakit,
            'status'           => $request->input('status', 'Kondisi Baik & Terkontrol'),
            'id_user'          => $user ? $user->id_user : null,
        ]);

        return $this->sendResponse($data, 'Pemeriksaan lansia berhasil dicatat.', 201);
    }

    /**
     * Riwayat pemeriksaan balita.
     */
    public function historyBalita(): JsonResponse
    {
        $list = PemeriksaanBalita::orderBy('tanggal', 'desc')->take(20)->get();
        return $this->sendResponse($list, 'Riwayat pemeriksaan balita berhasil diambil.');
    }

    /**
     * Riwayat pemeriksaan ibu hamil.
     */
    public function historyBumil(): JsonResponse
    {
        $list = PemeriksaanBumil::orderBy('tanggal', 'desc')->take(20)->get();
        return $this->sendResponse($list, 'Riwayat pemeriksaan ibu hamil berhasil diambil.');
    }

    /**
     * Riwayat pemeriksaan remaja.
     */
    public function historyRemaja(): JsonResponse
    {
        $list = PemeriksaanRemaja::orderBy('tanggal', 'desc')->take(20)->get();
        return $this->sendResponse($list, 'Riwayat skrining remaja berhasil diambil.');
    }

    /**
     * Riwayat pemeriksaan lansia.
     */
    public function historyLansia(): JsonResponse
    {
        $list = PemeriksaanLansia::orderBy('tanggal', 'desc')->take(20)->get();
        return $this->sendResponse($list, 'Riwayat pemeriksaan lansia berhasil diambil.');
    }
}

