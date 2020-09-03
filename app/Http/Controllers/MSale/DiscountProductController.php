<?php

namespace App\Http\Controllers\MSale;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MSale\CreateDiscountProductRequest;
use App\Http\Requests\MSale\UpdateDiscountProductRequest;
use App\Repositories\MSale\IDiscountProductRepository;
use App\Services\MProductService;
use App\Models\MSale\DiscountProduct;

class DiscountProductController extends Controller
{
    private $discountProductRepository;
    private $productService;

    public function __construct(IDiscountProductRepository $discountProductRepository, MProductService $productService)
    {
        $this->discountProductRepository = $discountProductRepository;
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = $this->discountProductRepository->all();

        return view('msale.d_p_index', compact('discounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiscountProductRequest $request)
    {
        $discount = $this->discountProductRepository->store($request);

        return response()->json([
            'message' => 'Berhasil tambah diskon produk'
        ]);
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
        $product->update($request->validated());

        return response()->json([
            'message' => 'Berhasil ubah diskon produk'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiscountProduct $product)
    {   
        $this->discountProductRepository->destroy($product);

        return redirect()->back()->with('success', 'Berhasil hapus diskon produk');
    }

    public function searchProduct(Request $request)
    {
        $products = $this->productService->searchProductsWithoutDiscounts($request);

        return response()->json($products);
    }
}
