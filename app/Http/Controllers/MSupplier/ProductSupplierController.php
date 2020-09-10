<?php

namespace App\Http\Controllers\MSupplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MSupplier\CreateProductSupplierRequest;
use App\Http\Requests\MSupplier\UpdateProductSupplierRequest;
use App\Policies\MSupplier\ProductSupplierPolicy;
use App\Repositories\MSupplier\IProductSupplierRepository;
use App\Services\MUserService;
use App\Services\MSupplierService;
use App\Models\MSupplier\ProductSupplier;

class ProductSupplierController extends Controller
{
    private $productSupplierPolicy;
    private $productSupplierRepository;
    private $userService;
    private $supplierService;

    public function __construct(
        ProductSupplierPolicy $productSupplierPolicy,
        IProductSupplierRepository $productSupplierRepository, 
        MUserService $userService,
        MSupplierService $supplierService
    )
    {
        $this->productSupplierPolicy = $productSupplierPolicy;
        $this->productSupplierRepository = $productSupplierRepository;
        $this->userService = $userService;
        $this->supplierService = $supplierService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $access = $this->productSupplierPolicy->access();

        if($access->view != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk melihat barang');
        }
        else
        {
            $suppliers = $this->supplierService->allSuppliers();

            if($request->ajax())
            {
                return $this->productSupplierRepository->renderDataTable($request, $suppliers, $access);
            }

            $views = $this->userService->menusRole();

            return view('msupplier/p_s_index', compact('suppliers', 'access', 'views'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductSupplierRequest $request)
    {
        $access = $this->productSupplierPolicy->access();

        if($access->add != 1)
        {
            return response()->json([
                'status'  => 'Fail',
                'message' => 'Tidak memiliki hak untuk tambah barang'
            ]);
        }
        else
        {
            ProductSupplier::create($request->validated());

            return response()->json([
                'status' => 'Success',
                'message' => 'Berhasil tambah barang'
            ]);
        }
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
        $access = $this->productSupplierPolicy->access();

        if($access->edit != 1)
        {
            return response()->json([
                'status'  => 'Fail',
                'message' => 'Tidak memiliki hak untuk ubah barang'
            ]);
        }
        else
        {
            $this->productSupplierRepository->update($request, $product);
            
            return response()->json([
                'status'  => 'Success',
                'message' => 'Berhasil ubah barang'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductSupplier $product)
    {
        $access = $this->productSupplierPolicy->access();

        if($access->delete != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk hapus barang');
        }
        else
        {
            $this->productSupplierRepository->destroy($product);

            return redirect()->back()->with('success', 'Berhasil hapus barang');
        }
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
