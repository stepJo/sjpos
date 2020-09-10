<?php

namespace App\Http\Controllers\MSupplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MSupplier\CreateSupplierRequest;
use App\Http\Requests\MSupplier\UpdateSupplierRequest;
use App\Policies\MSupplier\SupplierPolicy;
use App\Repositories\MSupplier\ISupplierRepository;
use App\Services\MUserService;
use App\Models\MSupplier\Supplier;
use Roles;

class SupplierController extends Controller
{
    private $supplierPolicy;
    private $supplierRepository;
    private $userService;

    public function __construct(
        SupplierPolicy $supplierPolicy,
        ISupplierRepository $supplierRepository, 
        MUserService $userService
    )
    {
        $this->supplierPolicy = $supplierPolicy;
        $this->supplierRepository = $supplierRepository;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $access = $this->supplierPolicy->access();

        if($access->view != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk melihat penyuplai');
        }
        else
        {
            $suppliers = $this->supplierRepository->all();

            $views = $this->userService->menusRole();

            return view('msupplier.s_index', compact('suppliers', 'access', 'views'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSupplierRequest $request)
    {   
        $access = $this->supplierPolicy->access();

        if($access->add != 1)
        {
            return response()->json([
                'status'  => 'Fail',
                'message' => 'Tidak memiliki hak untuk tambah penyuplai'
            ]);
        }
        else
        {
            $this->supplierRepository->store($request);

            return response()->json([
                'status'  => 'Success',
                'message' => 'Berhasil tambah penyuplai'
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
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $access = $this->supplierPolicy->access();

        if($access->edit != 1)
        {
            return response()->json([
                'status'  => 'Fail',
                'message' => 'Tidak memiliki hak untuk ubah penyuplai'
            ]);
        }
        else
        {
            $this->supplierRepository->update($request, $supplier);

            return response()->json([
                'status'  => 'Success',
                'message' => 'Berhasil ubah penyuplai'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $access = $this->supplierPolicy->access();

        if($access->delete != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk hapus penyuplai');
        }
        else
        {
            $this->supplierRepository->destroy($supplier);

            return redirect()->back()->with('success', 'Berhasil hapus penyuplai');
        }
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
