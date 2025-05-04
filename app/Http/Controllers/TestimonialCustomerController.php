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

    public function datatable(Request $request)
    {
        $data = Testimonial::orderBy('created_at', 'desc')->get();

        return DataTables::of($data)->make();
    }
}
