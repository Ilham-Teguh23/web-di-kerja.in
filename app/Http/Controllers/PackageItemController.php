<?php

namespace App\Http\Controllers;

use App\Models\PackageItem;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\MetaDataPriceItem;
use Illuminate\Support\Facades\DB;
use App\Models\MetaDataFavoriteItem;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\MetaDataDetailConsultant;
use App\Models\PackageServiceConsultation;

class PackageItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $packageItem;

    public function __construct()
    {
        $this->packageItem = new PackageItem();
    }

    public function index()
    {
        return view("dashboard.package-item");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string',
            'deskripsi' => 'nullable|string',
            'price' => 'nullable|exists:meta_price_package_service,id',
            'uploaded_image' => 'nullable|string',
            'consultant' => 'nullable|array'
        ]);

        try {
            DB::beginTransaction();

            $imageFilename = $request->uploaded_image;

            $package = PackageItem::create([
                'name' => $request->name,
                'description' => $request->deskripsi,
                'meta_price_package_service_id' => $request->price,
                'image_path' => $imageFilename,
            ]);

            // Simpan ke tabel pivot konsultasi
            if ($request->has('consultant')) {
                foreach ($request->consultant as $consultantId) {
                    PackageServiceConsultation::create([
                        'package_service_id' => $package->id,
                        'consultation_detail_id' => $consultantId
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
        
            // Hapus file jika perlu
            if ($request->uploaded_image) {
                $path = public_path('storage/image_item_package/' . $request->uploaded_image);
                if (File::exists($path)) {
                    File::delete($path);
                }
            }
        
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            DB::beginTransaction();

            // Ambil data utama + relasi (misal: 'category', 'packages')
            $data = $this->packageItem
                ->with(['price', 'FavoriteItem', 'packageConsultation.detailConsultant']) // Ganti sesuai relasi yang kamu punya
                ->where("id", $id)
                ->first();

            // dd($data);

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


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'deskripsi' => 'nullable|string',
            'price' => 'nullable|exists:meta_price_package_service,id',
            'uploaded_image' => 'nullable|string',
            'consultant' => 'nullable|array'
        ]);

        try {
            DB::beginTransaction();

            $package = PackageItem::findOrFail($id);

            $imageFilename = $request->uploaded_image;

            // Kalau ada perubahan gambar baru
            if ($imageFilename && $imageFilename !== $package->image_path) {
                // Hapus file lama pakai unlink
                if (!empty($package->image_path)) {
                    $oldFilePath = public_path('storage/image_item_package/' . $package->image_path);
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath); // <-- pakai unlink di sini
                    }
                }

                // Set image baru
                $package->image_path = $imageFilename;
            }

            // Update data lain
            $package->name = $request->name;
            $package->description = $request->deskripsi;
            $package->meta_price_package_service_id = $request->price;
            $package->save();

            // Hapus semua relasi konsultasi lama
            PackageServiceConsultation::where('package_service_id', $id)->delete();

            // Insert relasi konsultasi baru
            if ($request->has('consultant')) {
                foreach ($request->consultant as $consultantId) {
                    PackageServiceConsultation::create([
                        'package_service_id' => $package->id,
                        'consultation_detail_id' => $consultantId
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diupdate'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            // Kalau error, hapus file baru yang sudah diupload
            if ($request->uploaded_image && $request->uploaded_image !== $package->image_path) {
                $path = public_path('storage/image_item_package/' . $request->uploaded_image);
                if (file_exists($path)) {
                    unlink($path); // <-- juga pakai unlink di sini
                }
            }

            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            // AMBIL dulu datanya
            $item = $this->packageItem->where("id", $id)->first();

            if ($item) {
                // Hapus file gambar kalau ada
                if (!empty($item->image_path)) {
                    $filename = basename($item->image_path);
                    $filePath = public_path('storage/image_item_package/' . $filename);

                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }
                }

                // Baru hapus record database
                $item->delete();
            }

            // Hapus relasi konsultasi
            PackageServiceConsultation::where('package_service_id', $id)->delete();

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


    public function getPriceOptions()
    {
        $prices = MetaDataPriceItem::select('id', 'price')->get();

        return response()->json($prices);
    }


    public function getFavoriteItemOptions()
    {
        $favoriteIems = MetaDataFavoriteItem::select('id', 'name')->get();

        return response()->json($favoriteIems);
    }


    public function getItemConsultantOptions(Request $request)
    {
        $search = $request->input('term');

        $query = MetaDataDetailConsultant::query();

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }

        $consultants = $query->select('id', 'name')->limit(10)->get();

        return response()->json($consultants);
    }

    public function datatable(Request $request)
    {
        $data = PackageItem::with(['price', 'FavoriteItem', 'packageConsultation.detailConsultant'])->orderBy('created_at', 'desc')->get();

        // dd($data);
        return DataTables::of($data)->make();
    }

    public function updateStatus(Request $request, $id)
    {
        $package = PackageItem::findOrFail($id);
        $package->meta_favorite_item_id = $request->favorite_id ?? null;
        $package->save();

        return response()->json([
            'status' => true,
            'message' => 'Favorite berhasil diset.'
        ]);
    }

    public function uploadImage(Request $request)
{
    if ($request->hasFile('file')) {
        $file = $request->file('file');

        $extension = $file->getClientOriginalExtension();
        $encryptedName = md5($file->getClientOriginalName() . time()) . '.' . $extension;

        $dir = 'storage/image_item_package/';
        $relativePath = $dir . $encryptedName;
        $fullPath = public_path($relativePath);

        if (!File::exists(dirname($fullPath))) {
            File::makeDirectory(dirname($fullPath), 0755, true);
        }

        try {
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
    $path = public_path('storage/image_item_package/' . $filename); // GANTI INI

    if (file_exists($path)) {
        unlink($path);
        return response()->json(['status' => true, 'message' => 'File berhasil dihapus.']);
    }

    return response()->json(['status' => false, 'message' => 'File tidak ditemukan: ' . $path], 404);
}

    



}
