<?php

namespace App\Http\Controllers\MSupplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MSupplier\CreatePurchasementSupplierRequest;
use App\Repositories\MSupplier\IPurchasementSupplierRepository;
use App\Models\MSupplier\PurchasementSupplier;

class PurchasementSupplierController extends Controller
{
    private $purchasementSupplierRepository;

    public function __construct(IPurchasementSupplierRepository $purchasementSupplierRepository)
    {
        $this->purchasementSupplierRepository = $purchasementSupplierRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $suppliers = $this->purchasementSupplierRepository->allSupplier();

        if($request->ajax())
        {
            return $this->purchasementSupplierRepository->renderDataTable($request);
        }

        return view('msupplier/pch_s_index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = $this->purchasementSupplierRepository->allSupplierWithProducts();

        return view('msupplier/pch_s_a', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePurchasementSupplierRequest $request)
    {
        $this->purchasementSupplierRepository->store($request);

        return response()->json(['message' => 'Pembelian barang berhasil']);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchasementSupplier $purchasement)
    {
        $this->purchasementSupplierRepository->destroy($purchasement);

        return redirect()->back()->with('success', 'Berhasil hapus pembelian barang');
    }

    public function searchProduct(Request $request)
    {
        $products = $this->purchasementSupplierRepository->searchProduct($request);

    	return response()->json($products);
    }

    public function exportCSV()
    {
        return $this->purchasementSupplierRepository->exportCSV();
    }

    public function exportExcel()
    {
        return $this->purchasementSupplierRepository->exportExcel();
    }

    public function exportPDF()
    {
        return $this->purchasementSupplierRepository->exportPDF();
    }
}
