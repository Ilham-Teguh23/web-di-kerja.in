<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\TestimonialCustomer;
use Illuminate\Support\Facades\File;

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
        // dd($request->all());
        $request->validate([
            'uploaded_image' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $imageFilename = $request->uploaded_image;

            TestimonialCustomer::create([
                'gambar' => $imageFilename,
                'status' => '0'
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
        
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
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
        // dd($request->all())  ;
        $request->validate([
            'uploaded_image' => 'nullable|string',
        ]);
        
        try {
            DB::beginTransaction();
            
            $package = TestimonialCustomer::findOrFail($id);
            
            $imageFilename = $request->uploaded_image;
            
            if ($imageFilename && $imageFilename !== $package->gambar) {
                if (!empty($package->gambar)) {
                    $oldFilePath = public_path('storage/testimonial-costumer/' . $package->gambar);
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath); // <-- pakai unlink di sini
                    }
                }
                
                $package->gambar = $imageFilename;
            }

            $package->save();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diupdate'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $item = $this->testimonialCustomers->where("id", $id)->first();

            if ($item) {
                if (!empty($item->gambar)) {
                    $filename = basename($item->gambar);
                    $filePath = public_path('storage/testimonial-costumer/' . $filename);

                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }
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
        // dd($request);
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
