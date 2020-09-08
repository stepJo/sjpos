<?php

namespace App\Http\Controllers\MBranch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MBranch\CreateBranchRequest;
use App\Http\Requests\MBranch\UpdateBranchRequest;
use App\Repositories\MBranch\IBranchRepository;
use App\Services\MUserService;
use App\Models\MBranch\Branch;
use Roles;

class BranchController extends Controller
{
    private $branchRepository;
    private $userService;

    public function __construct(IBranchRepository $branchRepository, MUserService $userService)
    {
        $this->branchRepository = $branchRepository;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $views = $this->userService->menusRole();

        if(!Roles::canView('Cabang', $views))
        {
            return redirect('dashboard');
        }

        if($request->ajax())
        {
            return $this->branchRepository->renderDataTable();
        }

        return view('mbranch.b_index', compact('views'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBranchRequest $request)
    {
        $this->branchRepository->store($request);

        return response()->json(['message' => 'Berhasil tambah cabang']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        $this->branchRepository->update($request, $branch);
        
        return response()->json([
            'message' => 'Berhasil ubah cabang'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        $this->branchRepository->destroy($branch);

        return redirect()->back()->with('success', 'Berhasil hapus cabang');
    }

    public function exportCSV()
    {
        return $this->branchRepository->exportCSV();
    }

    public function exportExcel()
    {
        return $this->branchRepository->exportExcel();
    }

    public function exportPDF()
    {
        return $this->branchRepository->exportPDF();
    }
}
