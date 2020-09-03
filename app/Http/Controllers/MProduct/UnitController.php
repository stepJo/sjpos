<?php

namespace App\Http\Controllers\MProduct;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MProduct\CreateUnitRequest;
use App\Http\Requests\MProduct\UpdateUnitRequest;
use App\Repositories\MProduct\IUnitRepository;
use App\Services\MProductService;
use App\Models\MProduct\Unit;

class UnitController extends Controller
{
    private $unitRepository;
    private $unitService;

    public function __construct(IUnitRepository $unitRepository, MProductService $unitService)
    {
        $this->unitRepository = $unitRepository;
        $this->unitService = $unitService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = $this->unitService->unitsProducts();  

        return view('mproduct.u_index', compact('units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUnitRequest $request)
    {
        $this->unitRepository->store($request);

        return response()->json([
            'message' => 'Berhasil tambah satuan'
        ]);
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
        $this->unitRepository->update($request, $unit);
        
        return response()->json([
            'message' => 'Berhasil ubah satuan'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        $this->unitRepository->destroy($unit);

        return redirect()->back()->with('success', 'Berhasil hapus satuan');
    }
}
