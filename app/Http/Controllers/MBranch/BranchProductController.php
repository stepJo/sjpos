<?php

namespace App\Http\Controllers\MBranch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MBranch\CreateBranchProductRequest;
use App\Http\Requests\MBranch\UpdateBranchProductRequest;
use App\Repositories\MBranch\IBranchProductRepository;

class BranchProductController extends Controller
{
    private $branchProductRepository;

    public function __construct(IBranchProductRepository $branchProductRepository)
    {
        $this->branchProductRepository = $branchProductRepository;
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
            return $this->branchProductRepository->renderDataTable();
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
        $branches = $this->branchProductRepository->all();

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $branch = $this->branchProductRepository->find($id);

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
        $this->branchProductRepository->destroy($id);

        return redirect()->back()->with('success', 'Produk cabang kembali aktif');
    }

    public function getProduct($id)
    {
        $branch = $this->branchProductRepository->find($id);

        return response()->json(['branch' => $branch]);
    }

    public function searchProduct(Request $request)
    {
        return $this->branchProductRepository->searchProduct($request);
    }
}
