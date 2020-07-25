<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MProduct\Category;
use App\Models\MProduct\Product;
use App\Models\MProduct\Unit;
use App\Models\MSale\Transaction;
use App\Models\MSale\TransactionDetail;
use Keygen;

class POSController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get(['cat_id', 'cat_name']);
        $units = Unit::with('products')->get(['unit_id', 'unit_name']);

        $products = Product::with('category', 'category.products', 'unit', 'unit.products', 'discount', 'discount.product')
            ->select('p_id', 'cat_id', 'unit_id', 'p_code', 'p_name', 'p_price', 'p_image', 'p_status')
            ->get();

    	$not_actives = Product::where('p_status', 0)->count();
        
    	return view('pos', compact('categories', 'units', 'products', 'not_actives'));
    }

    public function allProduct()
    {
        $products = Product::with('discount')->get();

        return response()->json($products);
    }

    public function searchProduct(Request $request)
    {
    	$products = Product::with('discount')->where('p_name', 'LIKE', '%'.$request->p_name.'%')->where('p_code', 'LIKE', '%'.$request->p_code.'%')->get(['p_id', 'p_code', 'p_name', 'p_price', 'p_status']);

    	return response()->json($products);
    }

    public function searchCategory(Request $request)
    {   
        $data = Category::with('products', 'discounts')->findOrFail($request->cat_id);

        return response()->json($data);
    }

    public function searchUnit(Request $request)
    {
 
        $data = Unit::with('products', 'discounts')->findOrFail($request->unit_id);

        return response()->json($data);
    }

    public function saveTransaction(Request $request)
    {   
        $transaction = Transaction::create([
            't_code'  => Keygen::alphanum(6)->generate().date('hmsdmY'),
            't_type'  => $request->t_type,
            't_total' => $request->t_total,
            't_tax'   => $request->t_tax,
            't_disc'  => $request->t_disc
        ]);

        foreach($request->products as $p)
        {
            $detail = TransactionDetail::create([
                't_id'      => $transaction->t_id,
                'p_id'      => $p['p_id'],
                'qty'       => $p['p_qty'],
                'sub_total' => (int) $p['p_qty'] * $p['p_price']
            ]);
        }

        return 'Transaksi berhasil';  
    }
}
