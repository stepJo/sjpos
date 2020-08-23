<?php

namespace App\Http\Controllers\MSupplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MSupplier\CreateSupplierRequest;
use App\Http\Requests\MSupplier\UpdateSupplierRequest;
use App\Repositories\MSupplier\ISupplierRepository;
use App\Models\MSupplier\Supplier;

class SupplierController extends Controller
{
    private $supplierRepository;

    public function __construct(ISupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = $this->supplierRepository->all();

        return view('msupplier.s_index', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSupplierRequest $request)
    {   
        $this->supplierRepository->store($request);

        return response()->json(['message' => 'Berhasil tambah penyuplai']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {   
        $this->supplierRepository->update($request, $supplier);

        return response()->json(['message' => 'Berhasil ubah penyuplai']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $this->supplierRepository->destroy($supplier);

        return redirect()->back()->with('success', 'Berhasil hapus penyuplai');
    }

    public function exportCSV()
    {
        return $this->supplierRepository->exportCSV();
    }

    public function exportExcel()
    {
        return $this->supplierRepository->exportExcel();
    }

    public function exportPDF()
    {
        return $this->supplierRepository->exportPDF();
    }
}
