<?php

namespace App\Http\Controllers\MSupplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MSupplier\CreateProductSupplierRequest;
use App\Http\Requests\MSupplier\UpdateProductSupplierRequest;
use App\Repositories\MSupplier\IProductSupplierRepository;
use App\Services\MSupplierService;
use App\Models\MSupplier\ProductSupplier;

class ProductSupplierController extends Controller
{
    private $productSupplierRepository;
    private $supplierService;

    public function __construct(IProductSupplierRepository $productSupplierRepository, MSupplierService $supplierService)
    {
        $this->productSupplierRepository = $productSupplierRepository;
        $this->supplierService =$supplierService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $suppliers = $this->supplierService->allSuppliers();

        if($request->ajax())
        {
            return $this->productSupplierRepository->renderDataTable($request, $suppliers);
        }

        return view('msupplier/p_s_index', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductSupplierRequest $request)
    {
        ProductSupplier::create($request->validated());

        return response()->json([
            'message' => 'Berhasil tambah barang'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductSupplierRequest $request, ProductSupplier $product)
    {
        $this->productSupplierRepository->update($request, $product);
        
        return response()->json([
            'message' => 'Berhasil ubah barang'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductSupplier $product)
    {
        $this->productSupplierRepository->destroy($product);

        return redirect()->back()->with('success', 'Berhasil hapus barang');
    }

    public function exportCSV()
    {
        return $this->productSupplierRepository->exportCSV();
    }

    public function exportExcel()
    {
        return $this->productSupplierRepository->exportExcel();
    }

    public function exportPDF()
    {
        return $this->productSupplierRepository->exportPDF();
    }
}
