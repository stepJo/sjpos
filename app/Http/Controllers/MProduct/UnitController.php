<?php

namespace App\Http\Controllers\MProduct;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Policies\MProduct\UnitPolicy;
use App\Http\Requests\MProduct\CreateUnitRequest;
use App\Http\Requests\MProduct\UpdateUnitRequest;
use App\Repositories\MProduct\IUnitRepository;
use App\Services\MUserService;
use App\Services\MProductService;
use App\Models\MProduct\Unit;

class UnitController extends Controller
{
    private $unitPolicy;
    private $unitRepository;
    private $userService;
    private $unitService;

    public function __construct(
        UnitPolicy $unitPolicy,
        IUnitRepository $unitRepository, 
        MUserService $userService, 
        MProductService $unitService
    )
    {
        $this->unitPolicy = $unitPolicy;
        $this->unitRepository = $unitRepository;
        $this->userService = $userService;
        $this->unitService = $unitService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $access = $this->unitPolicy->access();

        if($access->view != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk lihat satuan');
        }
        else
        {
            $units = $this->unitService->unitsProducts(); 
            
            $views = $this->userService->menusRole();

            return view('mproduct.u_index', compact('units', 'access', 'access', 'views'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUnitRequest $request)
    {
        $access = $this->unitPolicy->access();

        if($access->add != 1)
        {
            return response()->json([
                'status' => 'Fail',
                'message' => 'Tidak memiliki hak untuk tambah satuan'
            ]);
        }
        else
        {
            $this->unitRepository->store($request);

            return response()->json([
                'status' => 'Success',
                'message' => 'Berhasil tambah satuan'
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
    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        $access = $this->unitPolicy->access();

        if($access->edit != 1)
        {
            return response()->json([
                'status' => 'Fail',
                'message' => 'Tidak memiliki hak untuk ubah satuan'
            ]);
        }    
        else
        {
            $this->unitRepository->update($request, $unit);
            
            return response()->json([
                'status' => 'Success',
                'message' => 'Berhasil ubah satuan'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        $access = $this->unitPolicy->access();

        if($access->delete != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk hapus satuan');
        }
        else
        {
            $this->unitRepository->destroy($unit);

            return redirect()->back()->with('success', 'Berhasil hapus satuan');
        }
    }
}
