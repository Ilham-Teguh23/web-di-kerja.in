<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\TestimonialProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\ImageTestimonialProduct;

class TestimonialProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $testimonialProduct;

    public function __construct()
    {
        $this->testimonialProduct = new TestimonialProduct();
    }

    public function index()
    {
        return view("dashboard.testimonial-product.index");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'deskripsi' => 'required|string',
            'uploaded_images' => 'nullable|array'
        ]);

        DB::beginTransaction();

        try {
            $testimonial = TestimonialProduct::create([
                'nama' => $request->input('name'),
                'deskripsi' => $request->input('deskripsi'),
                'status' => '0'
            ]);

            if ($request->has('uploaded_images')) {
                foreach ($request->uploaded_images as $image) {
                    ImageTestimonialProduct::create([
                        'testimonial_product_id' => $testimonial->id,
                        'gambar' => $image
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {

            DB::beginTransaction();

            $data = $this->testimonialProduct
                ->with(['imageProduct'])
                ->where("id", $id)
                ->first();


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
    $request->validate([
        'editName' => 'required|string',
        'editDeskripsi' => 'nullable|string',
        'uploaded_images' => 'nullable|array',
        'existing_images' => 'nullable|array', // <-- Tambahan
    ]);

    try {
        DB::beginTransaction();

        $package = $this->testimonialProduct
            ->with(['imageProduct'])
            ->where("id", $id)
            ->firstOrFail();

        // Ambil semua gambar lama
        $oldImageNames = $package->imageProduct->pluck('gambar')->toArray();

        // Gambar yang akan disimpan ulang
        $existingImages = $request->existing_images ?? []; // dari gambar lama yang masih dipakai
        $uploadedImages = $request->uploaded_images ?? []; // dari gambar baru yang diupload

        // Hapus file lama dari folder jika tidak termasuk dalam existing_images
        foreach ($oldImageNames as $oldImage) {
            if (!in_array($oldImage, $existingImages)) {
                $path = public_path('storage/testimonial-product/' . $oldImage);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }

        // Hapus semua relasi gambar
        $package->imageProduct()->delete();

        // Simpan ulang gambar lama yang masih digunakan
        foreach ($existingImages as $img) {
            $package->imageProduct()->create([
                'gambar' => $img
            ]);
        }

        // Simpan gambar baru yang diupload
        foreach ($uploadedImages as $newImg) {
            $package->imageProduct()->create([
                'gambar' => $newImg
            ]);
        }

        // Update data utama
        $package->nama = $request->editName;
        $package->deskripsi = $request->editDeskripsi;
        $package->save();

        DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diperbarui'
        ]);
    } catch (\Exception $e) {
        DB::rollBack();

        // Jika gagal dan ada gambar baru, hapus gambar baru dari direktori
        if (!empty($request->uploaded_images)) {
            foreach ($request->uploaded_images as $img) {
                $path = public_path('storage/testimonial-product/' . $img);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }

        return response()->json([
            'status' => false,
            'message' => 'Gagal memperbarui data: ' . $e->getMessage()
        ], 500);
    }
}




    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $item = $this->testimonialProduct
                ->with('imageProduct')
                ->where("id", $id)
                ->first();

            if ($item) {
                foreach ($item->imageProduct as $image) {
                    $filePath = public_path('storage/testimonial-product/' . $image->gambar);
                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }
                    $image->delete();
                }
                $item->delete();
            }

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

            $this->testimonialProduct->where("id", $id)->update([
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

            $dir = 'storage/testimonial-product/';
            $relativePath = $dir . $encryptedName;
            $fullPath = public_path($relativePath);

            if (!File::exists(dirname($fullPath))) {
                File::makeDirectory(dirname($fullPath), 0755, true);
            }

            try {
                if ($request->has('old_filename')) {
                    $oldFileName = $request->input('old_filename');
                    $oldFilePath = public_path($dir . $oldFileName);

                    if (File::exists($oldFilePath)) {
                        File::delete($oldFilePath);
                    }
                }

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

        $path = public_path('storage/testimonial-product/' . $filename);

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
        $data = TestimonialProduct::orderBy('created_at', 'desc')->get();

        return DataTables::of($data)->make();
    }
}
