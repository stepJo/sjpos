<?php

namespace App\Http\Controllers\MProduct;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\MProduct\IBarcodeRepository;
use App\Models\MProduct\Product;

class BarcodeController extends Controller
{
    private $barcodeRepository;

    public function __construct(IBarcodeRepository $barcodeRepository)
    {
        $this->barcodeRepository = $barcodeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->barcodeRepository->all();

        return view('mproduct.b_index', compact('products'));
    }
    
    public function get($id)
    {   
        $product = $this->barcodeRepository->get($id);

        return response()->json($product);
    }
}
