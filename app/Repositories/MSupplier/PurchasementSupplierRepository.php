<?php 

namespace App\Repositories\MSupplier;
use App\Repositories\MSupplier\IPurchasementSupplierRepository;
use App\Exports\MSupplier\PurchasementSupplierExport;
use App\Models\MSupplier\Supplier;
use App\Models\MSupplier\ProductSupplier;
use App\Models\MSupplier\PurchasementSupplier;
use App\Models\MSupplier\DetailPurchasementSupplier;
use DataTables;
use Excel;
use PDF;
use Utilities;

class PurchasementSupplierRepository implements IPurchasementSupplierRepository
{
    public function renderDataTable($request)
    {
        if(!empty($request->start_date) && !empty($request->supplier) && $request->supplier != '*')
        {
            $purchasements = PurchasementSupplier::with('detailPurchasements', 'detailPurchasements.product', 'supplier')
                ->whereBetween('pch_date', [$request->start_date, $request->end_date])
                ->where('s_id', $request->supplier)
                ->get(); 
        }
        else if(!empty($request->start_date))
        {
            $purchasements = PurchasementSupplier::with('detailPurchasements', 'detailPurchasements.product', 'supplier')
                ->whereBetween('pch_date', [$request->start_date, $request->end_date])
                ->get(); 
        }
        else 
        {
            $purchasements = PurchasementSupplier::with('detailPurchasements', 'detailPurchasements.product', 'supplier')
                ->get();
        }

        return Datatables::of($purchasements)
            ->editColumn('pch_cost', function($purchasements) 
            {
                return Utilities::rupiahFormat($purchasements->pch_cost);
            })
            ->editColumn('pch_date', function($purchasements) 
            {
                return '<span class="badge badge-info">'.Utilities::dateFormat($purchasements->pch_date).'</span>';
            })
            ->editColumn('pch_note', function($purchasements) 
            {
                return Utilities::emptyFormat($purchasements->pch_note);
            })
            ->addColumn('actions', function($purchasements) 
            {
                $token = csrf_token();

                $total = Utilities::rupiahFormat($purchasements->pch_cost);

                $tax = Utilities::rupiahFormat($purchasements->pch_tax);

                $discount = Utilities::rupiahFormat($purchasements->pch_disc);

                $shipment = Utilities::rupiahFormat($purchasements->pch_ship);

                $date = Utilities::dateFormat($purchasements->pch_date);

                $details = '';

                foreach($purchasements->detailPurchasements as $dp) {
                    $details .= 
                    '
                    <tr>

                        <td>'.$dp->product->ps_name.'</td>

                        <td>'.$dp->qty.'</td>

                        <td>'.Utilities::rupiahFormat($dp->sub_total / $dp->qty).'</td>

                        <td>'.Utilities::rupiahFormat($dp->sub_total).'</td>
                    
                    </tr>
                    ';
                }

                return 
                    '
                    <div class="dropdown">
                        
                        <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            Aksi
                        
                        </button>

                        <div class="dropdown-menu mr-5" aria-labelledby="dropdownMenuLink">
                        
                            <a class="dropdown-item text-info" data-toggle="modal" data-target="#detModal'.$purchasements->pch_id.'">

                                <i class="fas fa-info-circle mr-1"></i> Detail

                            </a>
                        
                            <a class="dropdown-item text-danger" data-toggle="modal" data-target="#delModal'.$purchasements->pch_id.'">

                                <i class="fas fa-trash mr-1"></i> Hapus

                            </a>
                        
                        </div>

                    </div>

                    <div class="modal fade" id="detModal'.$purchasements->pch_id.'" tabindex="-1" role="dialog" aria-hidden="true">
                        
                        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                        
                            <div class="modal-content">
                            
                                <div class="modal-header">
                            
                                    <h5 class="modal-title">Detail Pembelian Barang <i class="nav-icon fas fa-truck ml-2"></i></h5>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        
                                        <span aria-hidden="true">&times;</span>
                                    
                                    </button>
                            
                                </div>
                            
                                <div class="modal-body">

                                    <p>Penyuplai : <span class="font-weight-bold">'.$purchasements->supplier->s_name.'</span></p>

                                    <table class="table table-hover">

                                        <thead>
                                    
                                            <th>Barang</th>

                                            <th>Jumlah</th>

                                            <th>Harga</th>

                                            <th>Sub Total</th>

                                        </thead>

                                        <tbody>

                                            '.$details.'

                                        </tbody>

                                    </table>

                                    <p class="ml-2 mt-4">Tanggal Pembelian : <span class="badge badge-info ml-1">'.$date.'</span></p>

                                    <p class="ml-2">Kode Pembelian : <span class="font-weight-bold ml-1">'.$purchasements->pch_code.'</span></p>

                                    <p class="ml-2">Pembelian Total : <span class="font-weight-bold ml-1">'.$total.'</span></p>

                                    <p class="ml-2">Pajak : <span class="font-weight-bold ml-1">'.$tax.'</span></p>

                                    <p class="ml-2">Diskon : <span class="font-weight-bold ml-1">'.$discount.'</span></p>
                                    
                                    <p class="ml-2">Pengiriman : <span class="font-weight-bold ml-1">'.$shipment.'</span></p>

                                    <p class="ml-2 mt-4">Catatan : <span class="font-weight-bold ml-1">'.Utilities::emptyFormat($purchasements->pch_note).'</span></p> 

                                </div>
                            
                            </div>

                        </div>

                    </div>

                    <div class="modal fade" id="delModal'.$purchasements->pch_id.'">
                                            
                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h4 class="modal-title">Hapus Pembelian Barang <i class="nav-icon fas fa-truck ml-2"></i></h4>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                            <span aria-hidden="true">&times;</span>
                                
                                        </button>
                                    
                                </div>

                                <form action="'.route('purchasement-supplier.destroy', $purchasements->pch_id).'" method="POST">

                                    <input type="hidden" name="_token" value="'.$token.'" />

                                    <input type="hidden" name="_method" value="DELETE">

                                    <div class="modal-body">
                                
                                        Yakin ingin menghapus pembelian barang dari penyuplai <b>'.$purchasements->supplier->s_name.'</b> ?
                            
                                    </div>
                                
                                    <div class="modal-footer justify-content-between">
                                    
                                        <button type="button" class="button-s1 button-grey" data-dismiss="modal">Batal</button>
                                    
                                        <button type="submit" class="button-s1 button-red">Hapus</button>
                                    
                                    </div>

                                </form>
                            
                            </div>
                        
                        </div>
                        
                    </div>';
            })
            ->with('sum_pch_cost', $purchasements->sum('pch_cost'))
            ->rawColumns(['pch_date', 'actions'])
            ->make(true);
    }

    public function allSupplier()
    {
        return Supplier::select('s_id', 's_name')->get();
    }

    public function allSupplierWithProducts()
    {
        return Supplier::with('products')->get(['s_id', 's_name']);
    }

    public function store($request)
    {
        $purchasement = PurchasementSupplier::create([
            'pch_code' => $request->pch_code,
            'pch_cost' => $request->pch_cost,
            'pch_tax'  => $request->pch_tax,
            'pch_disc' => $request->pch_disc,
            'pch_ship' => $request->pch_ship,
            's_id'     => $request->s_id,
            'pch_note' => $request->pch_note
        ]);

        foreach($request->products as $product)
        {
            $detail = DetailPurchasementSupplier::create([
                'pch_id'    => $purchasement->pch_id,
                'ps_id'     => $product['ps_id'],
                'qty'       => $product['qty'],
                'sub_total' => $product['qty'] * $product['ps_price']
            ]);
        }
    }

    public function destroy($purchasement)
    {
        return $purchasement->delete();
    }

    public function searchProduct($request)
    {
        return ProductSupplier::with('supplier')
            ->where('ps_name', 'LIKE', '%'.$request->ps_name.'%')
            ->where('ps_code', 'LIKE', '%'.$request->ps_code.'%')
            ->where('s_id', $request->s_id)
            ->get(['ps_id', 'ps_code', 'ps_name', 'ps_price', 's_id']);
    }

    public function exportCSV()
    {
        return Excel::download(new PurchasementSupplierExport, 'Data_Pembelian_Barang_'.date('d_F_Y').'.csv');
    }

    public function exportExcel()
    {
        return Excel::download(new PurchasementSupplierExport, 'Data_Pembelian_Barang_'.date('d_F_Y').'.xlsx');
    }

    public function exportPDF()
    {
        $purchasements = PurchasementSupplier::with('detailPurchasements', 'detailPurchasements.product', 'supplier')
            ->get();

        $pdf = PDF::loadView('msupplier.pch_s_pdf', compact('purchasements'));

        return $pdf->stream('Data_Pembelian_Barang_'.date('d_F_Y').'.pdf');
    }
}