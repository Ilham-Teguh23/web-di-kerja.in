<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class Controller
{
    /**
     * Validasi gambar yang diunggah lewat Dropzone di dashboard.
     * Mengembalikan response error bila file bukan gambar yang diizinkan.
     */
    protected function rejectInvalidImage(Request $request): ?JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
        ], [
            'file.required' => 'Tidak ada file yang diunggah.',
            'file.image' => 'File harus berupa gambar.',
            'file.mimes' => 'Format gambar harus JPG, PNG, WEBP, atau GIF.',
            'file.max' => 'Ukuran gambar maksimal 5 MB.',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first('file');

            // "error" dibaca oleh pesan bawaan Dropzone, "message" oleh SweetAlert di halaman dashboard
            return response()->json([
                'status' => false,
                'message' => $message,
                'error' => $message,
            ], 422);
        }

        return null;
    }
}
