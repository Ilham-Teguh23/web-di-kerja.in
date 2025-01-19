<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Benefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BenefitController extends Controller
{
    protected $benefit;

    public function __construct()
    {
        $this->benefit = new Benefit();
    }

    public function index()
    {
        return view("dashboard.benefit.index");
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $this->benefit->create([
                "judul" => $request->judul,
                "icon" => $request->icon,
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

            $data = $this->benefit->where("id", $id)->first();

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

            $this->benefit->where("id", $id)->update([
                "judul" => $request->judul,
                "icon" => $request->icon,
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

            $this->benefit->where("id", $id)->delete();

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

            $this->benefit->where("id", $id)->update([
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

    public function datatable(Request $request)
    {
        $data = Benefit::orderBy('created_at', 'desc')->get();

        return DataTables::of($data)->make();
    }
}
