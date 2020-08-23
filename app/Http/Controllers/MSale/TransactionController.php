<?php

namespace App\Http\Controllers\MSale;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\MSale\ITransactionRepository;
use App\Models\MSale\Transaction;

class TransactionController extends Controller
{
    private $transactionRepository;

    public function __construct(ITransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function index(Request $request) {
    	if($request->ajax())
	    {   
            return $this->transactionRepository->renderDataTable($request);
	    }

	    return view('msale.t_index');
    }

    public function destroy(Transaction $transaction)
    {
        $this->transactionRepository->destroy($transaction);

        return redirect()->back()->with('success', 'Berhasil hapus transaksi');
    }

    public function exportCSV()
    {
        return $this->transactionRepository->exportCSV();
    }

    public function exportExcel()
    {
        return $this->transactionRepository->exportExcel();
    }

    public function exportPDF()
    {
        return $this->transactionRepository->exportPDF();
    }
}
