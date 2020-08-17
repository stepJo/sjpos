<?php

namespace App\Http\Controllers\MSupplier;

use App\Http\Controllers\Controller;
use App\Http\Requests\MSupplier\CreateSupplierRequest;
use App\Http\Requests\MSupplier\UpdateSupplierRequest;
use Illuminate\Http\Request;
use App\Models\MSupplier\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();

        return view('msupplier.s_index', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSupplierRequest $request)
    {   
        Supplier::create($request->validated());

        return response()->json(['message' => 'Berhasil tambah penyuplai']);
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
        $supplier->update($request->validated());

        return response()->json(['message' => 'Berhasil ubah penyuplai']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->back()->with('success', 'Berhasil hapus penyuplai');
    }
}
