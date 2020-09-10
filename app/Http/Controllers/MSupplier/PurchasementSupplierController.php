<?php

namespace App\Http\Controllers\MSupplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MSupplier\CreatePurchasementSupplierRequest;
use App\Policies\MSupplier\PurchasementSupplierPolicy;
use App\Repositories\MSupplier\IPurchasementSupplierRepository;
use App\Services\MUserService;
use App\Services\MSupplierService;
use App\Models\MSupplier\PurchasementSupplier;
use Roles;

class PurchasementSupplierController extends Controller
{
    private $purchasementSupplierPolicy;
    private $purchasementSupplierRepository;
    private $userService;
    private $supplierService;

    public function __construct(
        PurchasementSupplierPolicy $purchasementSupplierPolicy,
        IPurchasementSupplierRepository $purchasementSupplierRepository, 
        MUserService $userService, 
        MSupplierService $supplierService
    )
    {
        $this->purchasementSupplierPolicy = $purchasementSupplierPolicy;
        $this->purchasementSupplierRepository = $purchasementSupplierRepository;
        $this->userService =$userService;
        $this->supplierService =$supplierService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $access = $this->purchasementSupplierPolicy->access();

        if($access->view != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk melihat pembelian barang');
        }
        else
        {
            $suppliers = $this->supplierService->allSuppliers();

            if($request->ajax())
            {
                return $this->purchasementSupplierRepository->renderDataTable($request, $access);
            }

            $views = $this->userService->menusRole();

            return view('msupplier/pch_s_index', compact('suppliers', 'access', 'views'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $access = $this->purchasementSupplierPolicy->access();

        if($access->add != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk tambah pembelian barang');
        }
        else
        {
            $suppliers = $this->supplierService->suppliersProducts();

            $views = $this->userService->menusRole();

            return view('msupplier/pch_s_a', compact('suppliers', 'access', 'views'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePurchasementSupplierRequest $request)
    {
        $access = $this->purchasementSupplierPolicy->access();

        if($access->add != 1)
        {
            return response()->json([
                'status'  => 'Fail',
                'message' => 'Tidak memiliki hak akses untuk tambah pembelian barang'
            ]);  
        }
        else
        {
            $this->purchasementSupplierRepository->store($request);

            return response()->json([
                'status'  => 'Success',
                'message' => 'Pembelian barang berhasil'
            ]);  
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchasementSupplier $purchasement)
    {
        $access = $this->purchasementSupplierPolicy->access();

        if($access->delete != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk hapus pembelian barang');
        }
        else
        {
            $this->purchasementSupplierRepository->destroy($purchasement);

            return redirect()->back()->with('success', 'Berhasil hapus pembelian barang');
        }
    }

    public function searchProduct(Request $request)
    {
        $products = $this->supplierService->searchsupplierProducts($request);

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
