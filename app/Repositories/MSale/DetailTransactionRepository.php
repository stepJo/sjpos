<?php 

namespace App\Repositories\MSale;
use App\Repositories\MSale\IDetailTransactionRepository;
use App\Models\MSale\DetailTransaction;

class DetailTransactionRepository implements IDetailTransactionRepository
{
    function store($request, $transaction)
    {
        foreach($request->products as $p)
        {
            DetailTransaction::create([
                't_id'      => $transaction->t_id,
                'p_id'      => $p['p_id'],
                'qty'       => $p['p_qty'],
                'sub_total' => (int) $p['p_qty'] * $p['p_price']
            ]);
        }
    }
}