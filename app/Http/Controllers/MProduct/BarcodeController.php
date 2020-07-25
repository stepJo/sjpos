<?php

namespace App\Http\Controllers\MProduct;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MProduct\Product;

class BarcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get(['p_id', 'p_code', 'p_name', 'p_barcode']);

        return view('m_product.b_index', compact('products'));
    }
    
    public function get($id)
    {   
        $product = Product::findOrFail($id);

        return response()->json($product);
    }
}
