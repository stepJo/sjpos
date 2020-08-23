<?php 

namespace App\Repositories\MSupplier;
use App\Repositories\MSupplier\ISupplierRepository;
use App\Exports\MSupplier\SupplierExport;
use App\Models\MSupplier\Supplier;
use Excel;
use PDF;

class SupplierRepository implements ISupplierRepository
{
    public function all()
    {
        return Supplier::all();
    }

    public function store($request)
    {
        return Supplier::create($request->validated());
    }

    public function update($request, $supplier)
    {
        return $supplier->update($request->validated());
    }

    public function destroy($supplier)
    {
        return $supplier->delete();
    }

    public function exportCSV()
    {
        return Excel::download(new SupplierExport, 'Data_Penyuplai_'.date('d_F_Y').'.csv');
    }

    public function exportExcel()
    {
        return Excel::download(new SupplierExport, 'Data_Penyuplai_'.date('d_F_Y').'.xlsx');
    }

    public function exportPDF()
    {
        $suppliers = Supplier::all();
        
        $pdf = PDF::loadView('msupplier.s_pdf', compact('suppliers'));

        return $pdf->stream('Data_Penyuplai_'.date('d_F_Y').'.pdf');
    }
}