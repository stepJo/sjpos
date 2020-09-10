<?php

namespace App\Http\Controllers\MBranch;

use App\Http\Controllers\Controller;
use App\Policies\MBranch\BranchProductPolicy;
use Illuminate\Http\Request;
use App\Http\Requests\MBranch\CreateBranchProductRequest;
use App\Http\Requests\MBranch\UpdateBranchProductRequest;
use App\Repositories\MBranch\IBranchProductRepository;
use App\Services\MUserService;
use App\Services\MBranchService;
use App\Services\MProductService;

class BranchProductController extends Controller
{
    private $branchProductPolicy;
    private $branchProductRepository;
    private $branchService;
    private $productService;

    public function __construct(
        BranchProductPolicy $branchProductPolicy,
        IBranchProductRepository $branchProductRepository, 
        MUserService $userService,
        MBranchService $branchService,
        MProductService $productService
    )
    {
        $this->branchProductPolicy = $branchProductPolicy;
        $this->branchProductRepository = $branchProductRepository;
        $this->userService = $userService;
        $this->branchService = $branchService;
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $access = $this->branchProductPolicy->access();

        if($access->view != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk lihat produk cabang');
        }
        else
        {
            if($request->ajax())
            {   
                $branches = $this->branchService->branchesProducts();

                return $this->branchProductRepository->renderDataTable($branches, $access);
            }
            
            $views = $this->userService->menusRole();

            return view('mbranch.b_p_index', compact('access', 'views'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $access = $this->branchProductPolicy->access();

        if($access->add != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk tambah diaktivasi produk cabang');
        }
        else
        {
            $branches = $this->branchService->allBranches();

            $views = $this->userService->menusRole();

            return view('mbranch/b_p_a', compact('branches', 'access', 'views'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBranchProductRequest $request)
    {
        $access = $this->branchProductPolicy->access();

        if($access->add != 1)
        {
            return response()->json([
                'status'  => 'Fail',
                'message' => 'Tidak memiliki hak untuk tambah diaktivasi produk cabang'
            ]);
        }
        else
        {
            $this->branchProductRepository->store($request);

            return response()->json([
                'status'  => 'Success',
                'message' => 'Produk cabang tidak aktif'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $access = $this->branchProductPolicy->access();

        if($access->edit != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk ubah diaktivasi produk cabang');
        }

        $branch = $this->branchService->findBranchProducts($id);

        $views = $this->userService->menusRole();

        return view('mbranch.b_p_e', compact('branch', 'views'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBranchProductRequest $request)
    {
        $access = $this->branchProductPolicy->access();

        if($access->edit != 1)
        {
            return response()->json([
                'status'  => 'Fail',
                'message' => 'Tidak memiliki hak untuk ubah diaktivasi produk cabang'
            ]);
        }
        else
        {
            $this->branchProductRepository->update($request);

            return response()->json([
                'status'  => 'Success',
                'message' => 'Produk cabang yang tidak aktif berhasil diubah'
            ]);
        }
    }

    /**wwwwwwww
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $access = $this->branchProductPolicy->access();

        if($access->delete != 1)
        {
            return redirect()->back()->with('fail', 'Tidak memiliki hak untuk hapus diaktivasi produk cabang');
        }
        else
        {
            $this->branchService->destroyBranchProducts($id);

            return redirect()->back()->with('success', 'Produk cabang kembali aktif');
        }
    }

    public function getProduct($id)
    {
        $branch = $this->branchService->findBranchProducts($id);

        return response()->json(['branch' => $branch]);
    }

    public function searchProduct(Request $request)
    {
        return $this->productService->searchProducts($request);
    }
}
