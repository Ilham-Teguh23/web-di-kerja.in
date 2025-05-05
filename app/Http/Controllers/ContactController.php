<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     protected $contact;

     public function __construct()
     {
         $this->contact = new Contact();
     }
 
     public function index()
     {
         return view("dashboard.contact.index");
     }
 
     public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'alamat' => 'required|string',
            'email' => 'required|email',
            'telp' => 'required|string',
            'fb' => 'nullable|string',
            'ig' => 'nullable|string',
            'twit' => 'nullable|string',
            'tiktok' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction(); // Mulai transaksi

            // Simpan ke tabel contact
            Contact::create([
                'address' => $request->alamat,
                'phone' => $request->email,
                'email' => $request->telp,
                'link_fb' => $request->fb,
                'link_ig' => $request->ig,
                'link_twitter' => $request->twit,
                'link_tiktok' => $request->tiktok,
            ]);

            DB::commit(); // Commit jika semua berhasil

            return response()->json([
                'status' => true,
                'message' => 'Data kontak berhasil disimpan.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback jika ada error

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
 
             $data = $this->contact->where("id", $id)->first();
 
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
            'editAlamat' => 'required|string',
            'editTelp' => 'required|string',       // ✅ telp tidak harus email
            'editEmail' => 'required|email',       // ✅ email harus valid
            'editFb' => 'nullable|string',
            'editIg' => 'nullable|string',
            'editTwit' => 'nullable|string',
            'editTiktok' => 'nullable|string',
        ]);
        

        try {
            DB::beginTransaction(); // Mulai transaksi

            // Ambil data berdasarkan ID
            $contact = Contact::findOrFail($id);

            // Update data
            $contact->update([
                'address' => $request->editAlamat,
                'phone' => $request->editTelp,
                'email' => $request->editEmail,
                'link_fb' => $request->editFb,
                'link_ig' => $request->editIg,
                'link_twitter' => $request->editTwit,
                'link_tiktok' => $request->editTiktok,
            ]);

            DB::commit(); // Simpan perubahan

            return response()->json([
                'status' => true,
                'message' => 'Data kontak berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback jika gagal

            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

 
    public function destroy($id)
    {
        // dd($id);
        try {

            DB::beginTransaction();

            $this->contact->where("id", $id)->delete();

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
 
     public function datatable(Request $request)
     {
         $data = Contact::orderBy('created_at', 'desc')->get();
 
         return DataTables::of($data)->make();
     }
}
