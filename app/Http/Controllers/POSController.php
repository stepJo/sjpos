<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\MCustomer\CreateCustomerRequest;
use App\Policies\POSPolicy;
use App\Repositories\MCustomer\ICustomerRepository;
use App\Repositories\MSale\ITransactionRepository;
use App\Repositories\MSale\IDetailTransactionRepository;
use App\Services\MUserService;
use App\Services\MCustomerService;
use App\Services\MProductService;
use App\Models\MCustomer\Customer;
use App\Models\MProduct\Category;
use App\Models\MProduct\Unit;
use App\Models\MSale\Transaction;
use App\Models\MSale\DetailTransaction;
use Roles;

class POSController extends Controller
{   
    private $posPolicy;
    private $customerRepository;
    private $transactionRepository;
    private $detailTransactionRepository;
    private $userService;
    private $customerService;
    private $productService;

    public function __construct(
        POSPolicy $posPolicy,
        ICustomerRepository $customerRepository,
        ITransactionRepository $transactionRepository, 
        IDetailTransactionRepository $detailTransactionRepository, 
        MUserService $userService,
        MCustomerService $customerService,
        MProductService $productService
    )
    {
        $this->posPolicy = $posPolicy;
        $this->customerRepository = $customerRepository;
        $this->transactionRepository = $transactionRepository;
        $this->detailTransactionRepository = $detailTransactionRepository;
        $this->userService = $userService;
        $this->customerService = $customerService;
        $this->productService = $productService;
    }

    public function index()
    {
        $access = $this->posPolicy->access();

        if($access->view != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk akses POS');
        }
        else
        {
            $customers = $this->customerService->allCustomers();

            $disables = $this->productService->disableProducts(Auth::user()->b_id);

            $categories = $this->productService->categoriesProducts($disables);
            $units = $this->productService->unitsProducts($disables);

            $products = $this->productService->discountsProducts($disables);

            $not_actives = $this->productService->countNotActiveProducts($disables);

            $views = $this->userService->menusRole();

            return view('pos', compact('customers', 'categories', 'units', 'products', 'not_actives', 'views'));
        }
    }

    public function allProduct()
    {
        $disables = $this->productService->disableProducts(Auth::user()->b_id);

        $products = $this->productService->discountsProducts($disables);

        return response()->json($products);
    }

    public function searchProduct(Request $request)
    {
        $disables = $this->productService->disableProducts(Auth::user()->b_id);

        $products = $this->productService->searchProductsWithDiscounts($request, $disables);

    	return response()->json($products);
    }

    public function searchCategory(Request $request)
    {   
        $disables = $this->productService->disableProducts(Auth::user()->b_id);

        $category = $this->productService->searchCategoryProducts($request, $disables);

        return response()->json($category);
    }

    public function searchUnit(Request $request)
    {
        $disables = $this->productService->disableProducts(Auth::user()->b_id);

        $unit = $this->productService->searchUnitProducts($request, $disables);

        return response()->json($unit);
    }

    public function storeCustomer(CreateCustomerRequest $request)
    {
        $customer = $this->customerRepository->store($request);

        return response()->json([
            'status' => 'Success',
            'message' => 'Berhasil tambah pelanggan',
            'customer' => $customer
        ]);
    }

    public function storeTransaction(Request $request)
    {   
        $transaction = $this->transactionRepository->store($request);

        $this->detailTransactionRepository->store($request, $transaction);

        return response()->json([
            'status' => 'Success',
            'message' => 'Transaksi berhasil disimpan',
        ]);  
    }
}
