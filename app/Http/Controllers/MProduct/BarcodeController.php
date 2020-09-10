<?php

namespace App\Http\Controllers\MProduct;

use App\Http\Controllers\Controller;
use App\Policies\MProduct\BarcodePolicy;
use Illuminate\Http\Request;
use App\Repositories\MProduct\IBarcodeRepository;
use App\Services\MUserService;
use App\Services\MProductService;

class BarcodeController extends Controller
{
    private $barcodePolicy;
    private $barcodeRepository;
    private $productService;
    private $userService;

    public function __construct(
        BarcodePolicy $barcodePolicy,
        IBarcodeRepository $barcodeRepository, 
        MUserService $userService, 
        MProductService $productService
    )
    {
        $this->barcodePolicy = $barcodePolicy;
        $this->barcodeRepository = $barcodeRepository;
        $this->userService = $userService;
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $access = $this->barcodePolicy->access();

        if($access->view != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk lihat barcode');
        }
        else
        {
            $products = $this->productService->allProducts();

            if($request->ajax())
            {
                return $this->barcodeRepository->renderDataTable($products);
            }

            $views = $this->userService->menusRole();

            return view('mproduct.b_index', compact('products', 'views'));
        }
    }
    
    public function getProduct($id)
    {   
        $product = $this->productService->findProduct($id);

        return response()->json($product);
    }
}
