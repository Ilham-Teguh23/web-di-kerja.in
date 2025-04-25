<?php

namespace App\Http\Controllers;

use App\Models\PackageItem;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\MetaDataPriceItem;
use App\Models\MetaDataFavoriteItem;
use App\Models\MetaDataDetailConsultant;

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
        $search = $request->input('term'); // nilai dari Select2 saat search

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





}
