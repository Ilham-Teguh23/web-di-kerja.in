<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\MetaDataPriceItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PriceItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $priceItem;

    public function __construct()
    {
        $this->priceItem = new MetaDataPriceItem();
    }

    public function index()
    {
        return view("dashboard.meta-data.price-item.index");
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
        try {
            DB::beginTransaction();

            $cleanPrice = str_replace(['.', ','], ['', '.'], $request->price);

            $this->priceItem->create([
                "price" => $cleanPrice,
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


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // dd($id);
        try {

            DB::beginTransaction();

            $data = $this->priceItem->where("id", $id)->first();

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
        try {
            DB::beginTransaction();
            $cleanPrice = str_replace(['.', ','], ['', '.'], $request->price);

            $this->priceItem->where("id", $id)->update([
                "price" => $cleanPrice,
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


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            DB::beginTransaction();

            $this->priceItem->where("id", $id)->delete();

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
        $data = MetaDataPriceItem::orderBy('created_at')->get();

        // dd($data);
        return DataTables::of($data)->make();
    }
}
