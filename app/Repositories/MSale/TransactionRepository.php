<?php 

namespace App\Repositories\MSale;
use App\Repositories\MSale\ITransactionRepository;
use App\Exports\MSale\TransactionExport;
use App\Models\MSale\Transaction;
use DataTables;
use Excel;
use PDF;
use Utilities;

class TransactionRepository implements ITransactionRepository
{
    public function renderDataTable($request)
    {
        if(!empty($request->start_date))
        {
            $transactions = Transaction::with('detailTransactions', 'detailTransactions.product')
                ->whereBetween('t_date', [$request->start_date, $request->end_date])
                ->get(); 
        }
        else 
        {
            $transactions = Transaction::with('detailTransactions', 'detailTransactions.product')
                ->orderByDesc('t_date')
                ->get();
        }

        return Datatables::of($transactions)
            ->editColumn('t_total', function($transactions) 
            {
                return Utilities::rupiahFormat($transactions->t_total);
            })
            ->editColumn('t_tax', function($transactions) 
            {
                return Utilities::rupiahFormat($transactions->t_tax);
            })
            ->editColumn('t_disc', function($transactions) 
            {
                return Utilities::rupiahFormat($transactions->t_disc);
            })
            ->editColumn('t_date', function($transactions) 
            {
                return '<span class="badge badge-info">'.Utilities::dateFormat($transactions->t_date).'</span>';
            })
            ->addColumn('actions', function($transactions) 
            {
                $token = csrf_token();

                $total = Utilities::rupiahFormat($transactions->t_total);

                $tax = Utilities::rupiahFormat($transactions->t_tax);

                $disc = Utilities::rupiahFormat($transactions->t_disc);

                $date = date('d F Y H:i:s', strtotime($transactions->t_date));

                $details = '';

                foreach($transactions->detailTransactions as $td) {
                    $details .= 
                    '
                    <tr>

                        <td>'.$td->product->p_name.'</td>

                        <td>'.$td->qty.'</td>

                        <td>'.Utilities::rupiahFormat($td->sub_total / $td->qty).'</td>

                        <td>'.Utilities::rupiahFormat($td->sub_total).'</td>
                    
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
                        
                            <a class="dropdown-item text-info" data-toggle="modal" data-target="#detModal'.$transactions->t_id.'">

                                <i class="fas fa-info-circle mr-1"></i> Detail

                            </a>
                        
                            <a class="dropdown-item text-danger" data-toggle="modal" data-target="#delModal'.$transactions->t_id.'">

                                <i class="fas fa-trash mr-1"></i> Hapus

                            </a>
                        
                        </div>

                    </div>

                    <div class="modal fade" id="detModal'.$transactions->t_id.'" tabindex="-1" role="dialog" aria-hidden="true">
                        
                        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                        
                            <div class="modal-content">
                            
                                <div class="modal-header">
                            
                                    <h5 class="modal-title">Detail Transaksi <i class="fas fa-tags ml-2"></i></h5>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        
                                        <span aria-hidden="true">&times;</span>
                                    
                                    </button>
                            
                                </div>
                            
                                <div class="modal-body">

                                    <table class="table table-hover">

                                        <thead>

                                            <th>Produk</th>

                                            <th>Jumlah</th>

                                            <th>Harga</th>

                                            <th>Sub Total</th>

                                        </thead>

                                        <tbody>

                                            '.$details.'

                                        </tbody>

                                    </table>

                                    <p class="ml-2 mt-4">Tanggal Transaksi : <span class="badge badge-info ml-1">'.$date.'</span></p>

                                    <p class="ml-2">Kode Transaksi : <span class="font-weight-bold ml-1">'.$transactions->t_code.'</span></p>

                                    <p class="ml-2">Metode Bayar : <span class="font-weight-bold ml-1">'.$transactions->t_type.'</span></p>

                                    <p class="ml-2">Transaksi Total : <span class="font-weight-bold ml-1">'.$total.'</span></p>

                                    <p class="ml-2">Pajak : <span class="font-weight-bold ml-1">'.$tax.'</span></p>

                                    <p class="ml-2">Diskon : <span class="font-weight-bold ml-1">'.$disc.'</span></p>

                                </div>
                            
                            </div>

                        </div>

                    </div>

                    <div class="modal fade" id="delModal'.$transactions->t_id.'">
                                            
                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h4 class="modal-title">Hapus Transaksi <i class="fas fa-tags ml-2"></i></h4>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                            <span aria-hidden="true">&times;</span>
                                
                                        </button>
                                    
                                </div>

                                <form action="'.route('transaction.destroy', $transactions->t_id).'" method="POST">

                                    <input type="hidden" name="_token" value="'.$token.'" />

                                    <input type="hidden" name="_method" value="DELETE">

                                    <div class="modal-body">
                                
                                        Yakin ingin menghapus transaksi <b>'.$transactions->t_code.'</b> ?
                            
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
            ->with('sum_t_total', $transactions->sum('t_total'))
            ->rawColumns(['t_date', 'actions'])
            ->make(true);
    }

    public function destroy($transaction)
    {
        $transaction->delete();
    }

    public function exportCSV()
    {
        return Excel::download(new TransactionExport, 'Data_Transaksi_'.date('d_F_Y').'.csv');
    }

    public function exportExcel()
    {
        return Excel::download(new TransactionExport, 'Data_Transaksi_'.date('d_F_Y').'.xlsx');
    }

    public function exportPDF()
    {
        $transactions = Transaction::with('detailTransactions')->get();

        $pdf = PDF::loadView('msale.t_pdf', compact('transactions'));

        return $pdf->stream('Data_Produk_'.date('d_F_Y').'.pdf');
    }
}