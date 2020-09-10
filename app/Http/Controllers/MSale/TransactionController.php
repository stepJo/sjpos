<?php

namespace App\Http\Controllers\MSale;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Policies\MSale\TransactionPolicy;
use App\Repositories\MSale\ITransactionRepository;
use App\Services\MUserService;
use App\Models\MSale\Transaction;

class TransactionController extends Controller
{
    private $transactionPolicy;
    private $transactionRepository;
    private $userService;

    public function __construct(
        TransactionPolicy $transactionPolicy,
        ITransactionRepository $transactionRepository,
        MUserService $userService
    )
    {
        $this->transactionPolicy = $transactionPolicy;
        $this->transactionRepository = $transactionRepository;
        $this->userService = $userService;
    }

    public function index(Request $request) 
    {
        $access = $this->transactionPolicy->access();

        if($access->view != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk lihat riwayat transaksi');
        }
        else
        {
            if($request->ajax())
            {   
                return $this->transactionRepository->renderDataTable($request, $access);
            }
            
            $views = $this->userService->menusRole();

            return view('msale.t_index', compact('access', 'views'));
        }
    }

    public function destroy(Transaction $transaction)
    {
        $access = $this->transactionPolicy->access();

        if($access->delete != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk hapus riwayat transaksi');
        }
        else
        {
            $this->transactionRepository->destroy($transaction);

            return redirect()->back()->with('success', 'Berhasil hapus transaksi');
        }
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
