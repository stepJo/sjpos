<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MProduct\ICategoryRepository;
use App\Repositories\MProduct\IUnitRepository;
use App\Repositories\MSale\ITransactionRepository;
use App\Repositories\MSale\IDetailTransactionRepository;
use App\Services\MProductService;
use App\Models\MProduct\Category;
use App\Models\MProduct\Unit;
use App\Models\MSale\Transaction;
use App\Models\MSale\DetailTransaction;

class POSController extends Controller
{   
    private $categoryRepository;
    private $unitRepository;
    private $transactionRepository;
    private $detailTransactionRepository;
    private $productService;

    public function __construct(ICategoryRepository $categoryRepository, IUnitRepository $unitRepository, ITransactionRepository $transactionRepository, IDetailTransactionRepository $detailTransactionRepository, MProductService $productService)
    {
        $this->categoryRepository = $categoryRepository;
        $this->unitRepository = $unitRepository;
        $this->transactionRepository = $transactionRepository;
        $this->detailTransactionRepository = $detailTransactionRepository;
        $this->productService = $productService;
    }

    public function index()
    {
        $categories = $this->productService->categoriesProducts();
        $units = $this->productService->unitsProducts();

        $products = $this->productService->discountsProducts();

    	$not_actives = $this->productService->countNotActiveProducts();
        
    	return view('pos', compact('categories', 'units', 'products', 'not_actives'));
    }

    public function allProduct()
    {
        $products = $this->productService->discountsProducts();

        return response()->json($products);
    }

    public function searchProduct(Request $request)
    {
        $products = $this->productService->searchProductsWithDiscounts($request);

    	return response()->json($products);
    }

    public function searchCategory(Request $request)
    {   
        $category = $this->categoryRepository->search($request);

        return response()->json($category);
    }

    public function searchUnit(Request $request)
    {
        $unit = $this->unitRepository->search($request);

        return response()->json($unit);
    }

    public function storeTransaction(Request $request)
    {   
        $transaction = $this->transactionRepository->store($request);

        $this->detailTransactionRepository->store($request, $transaction);

        return 'Transaksi berhasil';  
    }
}
