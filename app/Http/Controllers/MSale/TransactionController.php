<?php

namespace App\Http\Controllers\MSale;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\MSale\ITransactionRepository;
use App\Services\MUserService;
use App\Models\MSale\Transaction;
use Roles;

class TransactionController extends Controller
{
    private $transactionRepository;
    private $userService;

    public function __construct(ITransactionRepository $transactionRepository, MUserService $userService)
    {
        $this->transactionRepository = $transactionRepository;
        $this->userService = $userService;
    }

    public function index(Request $request) 
    {
        $views = $this->userService->menusRole();

        if(!Roles::canView('Riwayat Transaksi', $views))
        {
            return redirect('dashboard');
        }

    	if($request->ajax())
	    {   
            return $this->transactionRepository->renderDataTable($request);
	    }

	    return view('msale.t_index', compact('views'));
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
