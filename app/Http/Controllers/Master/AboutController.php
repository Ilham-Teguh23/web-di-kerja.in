<?php

namespace App\Http\Controllers\Master;

use App\Models\About;
use Illuminate\Http\Request;
use App\Models\ListSuperiority;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\AboutListSuperiority;
use App\Models\ImageAbout;
use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    protected $About;

    public function __construct()
    {
        $this->About = new About();
    }

    public function index()
    {
        return view("dashboard.about.index");
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
        $request->validate([
            'keunggulan' => 'required|string',
            'titleKeunggulan' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'uploaded_images' => 'nullable|array',
            'listKeunggulan' => 'nullable|array',
        ]);

        try {
            DB::beginTransaction();

            $about = About::create([
                'keunggulan' => $request->keunggulan,
                'title_keunggulan' => $request->titleKeunggulan,
                'description' => $request->deskripsi,
            ]);

            if ($request->has('listKeunggulan')) {
                foreach ($request->listKeunggulan as $listKeunggulanId) {
                    AboutListSuperiority::create([
                        'about_id' => $about->id,
                        'list_superiority_id' => $listKeunggulanId
                    ]);
                }
            }

            if ($request->has('uploaded_images')) {
                foreach ($request->uploaded_images as $image) {
                    ImageAbout::create([
                        'about_id' => $about->id,
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

            // Hapus semua gambar jika error
            if (!empty($request->uploaded_images)) {
                foreach ($request->uploaded_images as $img) {
                    $path = public_path('storage/image_item_package/' . $img);
                    if (File::exists($path)) {
                        File::delete($path);
                    }
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
            $data = $this->About
                ->with(['imageAbout', 'AboutListSuperiority.listSuperiority',]) // Ganti sesuai relasi yang kamu punya
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
        'editKeunggulan' => 'required|string',
        'editTitleKeunggulan' => 'nullable|string',
        'editDescription' => 'nullable|string',
        'uploaded_images' => 'nullable|array',
        'existing_images' => 'nullable|array',
        'editListKeunggulan' => 'nullable|array',
    ]);

    try {
        DB::beginTransaction();

        $about = $this->About
            ->with(['imageAbout'])
            ->where("id", $id)
            ->firstOrFail();

        // Ambil semua gambar lama
        $oldImageNames = $about->imageAbout->pluck('gambar')->toArray();

        // Gabungkan semua gambar yang dikirim dari form
        $imagesToKeep = $request->existing_images ?? [];
        $newImages = $request->uploaded_images ?? [];

        // Hapus file di direktori jika tidak termasuk dalam `existing_images`
        foreach ($oldImageNames as $oldImage) {
            if (!in_array($oldImage, $imagesToKeep)) {
                $path = public_path('storage/about/' . $oldImage);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }

        // Hapus semua relasi gambar di DB
        $about->imageAbout()->delete();

        // Tambahkan kembali gambar dari existing_images
        foreach ($imagesToKeep as $existingImage) {
            $about->imageAbout()->create([
                'gambar' => $existingImage
            ]);
        }

        // Tambahkan gambar baru dari uploaded_images
        foreach ($newImages as $newImage) {
            $about->imageAbout()->create([
                'gambar' => $newImage
            ]);
        }

        // Update data utama
        $about->keunggulan = $request->editKeunggulan;
        $about->title_keunggulan = $request->editTitleKeunggulan;
        $about->description = $request->editDescription;
        $about->save();

        // Hapus dan insert ulang list keunggulan
        AboutListSuperiority::where('about_id', $id)->delete();

        if ($request->has('editListKeunggulan')) {
            foreach ($request->editListKeunggulan as $listSuperiority) {
                AboutListSuperiority::create([
                    'about_id' => $about->id,
                    'list_superiority_id' => $listSuperiority
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

    public function getListSuperiorityOptions(Request $request)
    {
        // dd($request);
        $search = $request->input('term');

        $query = ListSuperiority::query();

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }

        $listSuperiority = $query->select('id', 'name')->limit(10)->get();

        return response()->json($listSuperiority);
    }

    public function datatable(Request $request)
    {
        $data = About::with(['imageAbout', 'AboutListSuperiority.listSuperiority',])->orderBy('created_at', 'desc')->get();

        // dd($data);
        return DataTables::of($data)->make();
    }

    public function uploadImage(Request $request)
{
    if ($request->hasFile('file')) {
        $file = $request->file('file');

        $extension = $file->getClientOriginalExtension();
        $encryptedName = md5($file->getClientOriginalName() . time()) . '.' . $extension;

        $dir = 'storage/about/';
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

    $path = public_path('storage/about/' . $filename);

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

}
