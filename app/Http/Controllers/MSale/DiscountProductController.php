<?php

namespace App\Http\Controllers\MSale;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Policies\MSale\DiscountProductPolicy;
use App\Http\Requests\MSale\CreateDiscountProductRequest;
use App\Http\Requests\MSale\UpdateDiscountProductRequest;
use App\Repositories\MSale\IDiscountProductRepository;
use App\Services\MUserService;
use App\Services\MProductService;
use App\Models\MSale\DiscountProduct;

class DiscountProductController extends Controller
{
    private $discountProductPolicy;
    private $discountProductRepository;
    private $userService;
    private $productService;

    public function __construct(
        DiscountProductPolicy $discountProductPolicy,
        IDiscountProductRepository $discountProductRepository, 
        MUSerService $userService, 
        MProductService $productService
    )
    {
        $this->discountProductPolicy = $discountProductPolicy;
        $this->discountProductRepository = $discountProductRepository;
        $this->userService = $userService;
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $access = $this->discountProductPolicy->access();

        if($access->view != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk lihat diskon produk');
        }
        else
        {
            $discounts = $this->discountProductRepository->all();

            $views = $this->userService->menusRole();

            return view('msale.d_p_index', compact('discounts', 'access', 'views'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiscountProductRequest $request)
    {
        $access = $this->discountProductPolicy->access();

        if($access->add != 1)
        {
            return response()->json([
                'status' => 'Fail',
                'message' => 'Tidak memiliki hak untuk tambah diskon produk'
            ]);
        }
        else
        {
            $discount = $this->discountProductRepository->store($request);

            return response()->json([
                'status' => 'Success',
                'message' => 'Berhasil tambah diskon produk'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiscountProductRequest $request, DiscountProduct $product)
    {
        $access = $this->discountProductPolicy->access();

        if($access->edit != 1)
        {
            return response()->json([
                'status' => 'Fail',
                'message' => 'Tidak memiliki hak untuk ubah diskon produk'
            ]);
        }
        else
        {
            $product->update($request->validated());

            return response()->json([
                'message' => 'Berhasil ubah diskon produk'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiscountProduct $product)
    {   
        $access = $this->discountProductPolicy->access();

        if($access->delete != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk hapus diskon produk');
        }
        else
        {
            $this->discountProductRepository->destroy($product);

            return redirect()->back()->with('success', 'Berhasil hapus diskon produk');
        }
    }

    public function searchProduct(Request $request)
    {
        $products = $this->productService->searchProductsWithoutDiscounts($request);

        return response()->json($products);
    }
}
