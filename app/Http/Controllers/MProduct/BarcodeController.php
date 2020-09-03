<?php

namespace App\Http\Controllers\MProduct;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\MProduct\IBarcodeRepository;
use App\Services\MProductService;

class BarcodeController extends Controller
{
    private $barcodeRepository;
    private $productService;

    public function __construct(IBarcodeRepository $barcodeRepository, MProductService $productService)
    {
        $this->barcodeRepository = $barcodeRepository;
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $products = $this->productService->allProducts();

        if($request->ajax())
        {
            return $this->barcodeRepository->renderDataTable($products);
        }

        return view('mproduct.b_index', compact('products'));
    }
    
    public function getProduct($id)
    {   
        $product = $this->productService->findProduct($id);

        return response()->json($product);
    }
}
