<?php

namespace App\Http\Controllers\MSale;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MSale\CreateDiscountProductRequest;
use App\Http\Requests\MSale\UpdateDiscountProductRequest;
use App\Models\MProduct\Product;
use App\Models\MSale\DiscountProduct;


class DiscountProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = DiscountProduct::with('product')->get();

        //$discounts = DiscountProduct::with('product')->get();

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
        $discount = DiscountProduct::create($request->validated());

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

        $product->delete();

        return redirect()->back()->with('success', 'Berhasil hapus diskon produk');
    }

    public function searchProduct(Request $request)
    {
        $products = Product::with('discount')
            ->where('p_name', 'LIKE', '%'.$request->p_name.'%')
            ->where('p_code', 'LIKE', '%'.$request->p_code.'%')
            ->doesntHave('discount')
            ->get();

        return response()->json($products);
    }
}
