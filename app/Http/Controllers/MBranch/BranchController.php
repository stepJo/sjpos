<?php

namespace App\Http\Controllers\MBranch;

use App\Http\Controllers\Controller;
use App\Policies\MBranch\BranchPolicy;
use Illuminate\Http\Request;
use App\Http\Requests\MBranch\CreateBranchRequest;
use App\Http\Requests\MBranch\UpdateBranchRequest;
use App\Repositories\MBranch\IBranchRepository;
use App\Services\MUserService;
use App\Models\MBranch\Branch;

class BranchController extends Controller
{
    private $branchPolicy;
    private $branchRepository;
    private $userService;

    public function __construct(
        BranchPolicy $branchPolicy, 
        IBranchRepository $branchRepository, 
        MUserService $userService
    )
    {
        $this->branchPolicy = $branchPolicy;
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
        $access = $this->branchPolicy->access();

        if($access->view != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk melihat cabang');
        }
        else
        {
            if($request->ajax())
            {
                return $this->branchRepository->renderDataTable($access);
            }

            $views = $this->userService->menusRole();

            return view('mbranch.b_index', compact('access', 'views'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBranchRequest $request)
    {
        $access = $this->branchPolicy->access();

        if($access->add != 1)
        {
            return response()->json([
                'status'  => 'Fail',
                'message' => 'Tidak memiliki hak untuk tambah cabang'
            ]);
        }
        else
        {
            $this->branchRepository->store($request);

            return response()->json([
                'status'  => 'Success',
                'message' => 'Berhasil tambah cabang'
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
    public function update(UpdateBranchRequest $request, Branch $branch)
    {   
        $access = $this->branchPolicy->access();

        if($access->edit != 1)
        {
            return response()->json([
                'status'  => 'Fail',
                'message' => 'Tidak memiliki hak untuk ubah cabang'
            ]);
        }
        else
        {
            $this->branchRepository->update($request, $branch);
            
            return response()->json([
                'status'  => 'Success',
                'message' => 'Berhasil ubah cabang'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        $access = $this->branchPolicy->access();

        if($access->delete != 1)
        {
            return redirect()->back()->with('fail', 'Tidak memiliki hak untuk hapus cabang');
        }
        else
        {
            $this->branchRepository->destroy($branch);

            return redirect()->back()->with('success', 'Berhasil hapus cabang');
        }
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
