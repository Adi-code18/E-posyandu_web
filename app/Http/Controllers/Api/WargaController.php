<?php

namespace App\Http\Controllers\Api;

use App\Models\Kader;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WargaController extends BaseApiController
{
    /**
     * Menampilkan daftar warga sasaran (Balita, Bumil, Remaja, Lansia).
     */
    public function index(Request $request): JsonResponse
    {
        $query = Warga::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('NIK', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && $request->status !== 'Semua') {
            $query->where('status', $request->status);
        }

        $perPage = $request->input('per_page', 10);
        $warga = $query->orderBy('created_at', 'desc')->paginate($perPage);

        return $this->sendResponse($warga, 'Daftar data warga berhasil diambil.');
    }

    /**
     * Menampilkan detail profil satu warga berdasarkan NIK.
     */
    public function show(string $nik): JsonResponse
    {
        $warga = Warga::where('NIK', $nik)->first();

        if (!$warga) {
            return $this->sendError('Data warga dengan NIK tersebut tidak ditemukan.', [], 404);
        }

        return $this->sendResponse($warga, 'Detail data warga berhasil diambil.');
    }

    /**
     * Mendaftarkan warga baru melalui aplikasi mobile.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'NIK'           => 'required|numeric|digits:16|unique:warga,NIK',
            'nama_lengkap'  => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'status'        => 'required|string',
            'nama_ibu'      => 'nullable|string|max:255',
            'nama_ayah'     => 'nullable|string|max:255',
        ], [
            'NIK.required'       => 'NIK wajib diisi.',
            'NIK.digits'         => 'NIK harus terdiri dari 16 digit.',
            'NIK.unique'         => 'NIK sudah terdaftar sebelumnya.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib ditentukan.',
            'jenis_kelamin.required' => 'Pilih jenis kelamin.',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi formulir pendaftaran gagal.', $validator->errors()->all(), 422);
        }

        $kader = Kader::first();
        $user = User::first();

        $data = $validator->validated();
        $data['nama_ayah'] = !empty($data['nama_ayah']) ? $data['nama_ayah'] : '-';
        $data['nama_ibu'] = !empty($data['nama_ibu']) ? $data['nama_ibu'] : '-';
        $data['id_kader'] = $kader ? $kader->id_kader : null;
        $data['id_user'] = $user ? $user->id_user : null;

        $warga = Warga::create($data);

        return $this->sendResponse($warga, 'Warga baru berhasil didaftarkan.', 201);
    }

    /**
     * Memperbarui data warga.
     */
    public function update(Request $request, string $nik): JsonResponse
    {
        $warga = Warga::where('NIK', $nik)->first();

        if (!$warga) {
            return $this->sendError('Data warga tidak ditemukan.', [], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_lengkap'  => 'sometimes|required|string|max:255',
            'tanggal_lahir' => 'sometimes|required|date',
            'jenis_kelamin' => 'sometimes|required|in:Laki-laki,Perempuan',
            'status'        => 'sometimes|required|string',
            'nama_ibu'      => 'nullable|string|max:255',
            'nama_ayah'     => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validasi pembaruan gagal.', $validator->errors()->all(), 422);
        }

        $warga->update($validator->validated());

        return $this->sendResponse($warga, 'Data warga berhasil diperbarui.');
    }
}

