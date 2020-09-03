<?php

namespace App\Http\Controllers\MBranch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MBranch\CreateBranchProductRequest;
use App\Http\Requests\MBranch\UpdateBranchProductRequest;
use App\Repositories\MBranch\IBranchProductRepository;
use App\Services\MBranchService;
use App\Services\MProductService;


class BranchProductController extends Controller
{
    private $branchProductRepository;
    private $branchService;
    private $productService;

    public function __construct(IBranchProductRepository $branchProductRepository, MBranchService $branchService, MProductService $productService)
    {
        $this->branchProductRepository = $branchProductRepository;
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
        if($request->ajax())
	    {   
            $branches = $this->branchService->branchesProducts();

            return $this->branchProductRepository->renderDataTable($branches);
	    }

        return view('mbranch.b_p_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = $this->branchService->allBranches();

        return view('mbranch/b_p_a', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBranchProductRequest $request)
    {
        $this->branchProductRepository->store($request);

        return response()->json(['message' => 'Produk cabang tidak aktif']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch = $this->branchService->findBranchProducts($id);

        return view('mbranch.b_p_e', compact('branch'));
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
        $this->branchProductRepository->update($request);

        return response()->json(['message' => 'Produk cabang yang tidak aktif berhasil diubah']);
    }

    /**wwwwwwww
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->branchService->destroyBranchProducts($id);

        return redirect()->back()->with('success', 'Produk cabang kembali aktif');
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
