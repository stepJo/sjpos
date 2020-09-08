<?php

namespace App\Http\Controllers\MProduct;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\MProduct\IBarcodeRepository;
use App\Services\MUserService;
use App\Services\MProductService;
use Roles;

class BarcodeController extends Controller
{
    private $barcodeRepository;
    private $productService;
    private $userService;

    public function __construct(IBarcodeRepository $barcodeRepository, MUserService $userService, MProductService $productService)
    {
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
        $views = $this->userService->menusRole();

        if(!Roles::canView('Barcode', $views))
        {
            return redirect('dashboard');
        }

        $products = $this->productService->allProducts();

        if($request->ajax())
        {
            return $this->barcodeRepository->renderDataTable($products);
        }

        return view('mproduct.b_index', compact('products', 'views'));
    }
    
    public function getProduct($id)
    {   
        $product = $this->productService->findProduct($id);

        return response()->json($product);
    }
}
