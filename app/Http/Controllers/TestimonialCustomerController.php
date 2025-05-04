<?php

namespace App\Http\Controllers;

use App\Models\TestimonialCustomer;
use Illuminate\Http\Request;

class TestimonialCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $testimonialCustomers;

    public function __construct()
    {
        $this->testimonialCustomers = new TestimonialCustomer();
    }

    public function index()
    {
        return view("dashboard.testimonial-customer.index");
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $this->testimonialCustomers->create([
                "nama" => $request->nama,
                "role" => $request->role,
                "deskripsi" => $request->deskripsi,
                "status" => "0"
            ]);

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Data Berhasil di Tambah"
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        try {

            DB::beginTransaction();

            $data = $this->testimonialCustomers->where("id", $id)->first();

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Data Showed By ID Successfully",
                "data" => $data
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $this->testimonialCustomers->where("id", $id)->update([
                "nama" => $request->nama,
                "role" => $request->role,
                "deskripsi" => $request->deskripsi
            ]);

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Update Data Success"
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {

            DB::beginTransaction();

            $this->testimonialCustomers->where("id", $id)->delete();

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Delete Data Success"
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $this->testimonialCustomers->where("id", $id)->update([
                "status" => $request->status == "1" ? "1" : "0"
            ]);

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Update Status Success"
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $extension = $file->getClientOriginalExtension();
            $encryptedName = md5($file->getClientOriginalName() . time()) . '.' . $extension;

            $dir = 'storage/testimonial-costumer/';
            $relativePath = $dir . $encryptedName;
            $fullPath = public_path($relativePath);

            if (!File::exists(dirname($fullPath))) {
                File::makeDirectory(dirname($fullPath), 0755, true);
            }

            try {
                // Jika ada file lama, hapus file lama terlebih dahulu
                if ($request->has('old_filename')) {
                    $oldFileName = $request->input('old_filename');
                    $oldFilePath = public_path($dir . $oldFileName);

                    if (File::exists($oldFilePath)) {
                        File::delete($oldFilePath); // Hapus file lama
                    }
                }

                // Pindahkan file baru ke direktori tujuan
                $file->move(dirname($fullPath), $encryptedName);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal menyimpan file: ' . $e->getMessage()
                ], 500);
            }

            $publicPath = asset($relativePath);

            return response()->json([
                'status' => true,
                'filename' => $encryptedName,
                'path' => $publicPath
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Tidak ada file yang diunggah.'
        ], 400);
    }


    public function deleteUploadedImage(Request $request)
    {
        $filename = $request->input('filename');

        if (!$filename) {
            return response()->json([
                'status' => false,
                'message' => 'Nama file tidak diberikan.'
            ], 400);
        }

        $path = public_path('storage/testimonial-costumer/' . $filename);

        if (File::exists($path)) {
            try {
                File::delete($path);

                return response()->json([
                    'status' => true,
                    'message' => 'File berhasil dihapus.'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal menghapus file: ' . $e->getMessage()
                ], 500);
            }
        }

        return response()->json([
            'status' => false,
            'message' => 'File tidak ditemukan: ' . $path
        ], 404);
    }

    public function datatable(Request $request)
    {
        $data = TestimonialCustomer::orderBy('created_at', 'desc')->get();

        return DataTables::of($data)->make();
    }
}
