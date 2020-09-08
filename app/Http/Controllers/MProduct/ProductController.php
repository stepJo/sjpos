<?php

namespace App\Http\Controllers\MProduct;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MProduct\CreateProductRequest;
use App\Http\Requests\MProduct\UpdateProductRequest;
use App\Repositories\MProduct\IProductRepository;
use App\Services\MUserService;
use App\Models\MProduct\Category;
use App\Models\MProduct\Unit;
use App\Models\MProduct\Product;
use Roles;

class ProductController extends Controller
{
    private $productRepository;
    private $userService;

    public function __construct(IProductRepository $productRepository, MUserService $userService)
    {
        $this->productRepository = $productRepository;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $views = $this->userService->menusRole();

        if(!Roles::canView('Produk', $views))
        {
            return redirect('dashboard');
        }

        if($request->ajax())
        {
            return $this->productRepository->renderDataTable();
        }
        
        return view('mproduct.p_index', compact('views'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $units = Unit::all();

        return view('mproduct.p_a' ,compact('categories', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {   
        $this->productRepository->store($request);

        return redirect('product')->with('success', 'Berhasil tambah produk');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $units = Unit::all();

        return view('mproduct.p_e' ,compact('product', 'categories', 'units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {   
        $this->productRepository->update($request, $id);

        return redirect('product')->with('success', 'Berhasil ubah produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->productRepository->destroy($product);

        return redirect()->back()->with('success', 'Berhasil hapus produk');
    }

    public function exportCSV()
    {
        return $this->productRepository->exportCSV();
    }

    public function exportExcel()
    {
        return $this->productRepository->exportExcel();
    }

    public function exportPDF()
    {
        return $this->productRepository->exportPDF();
    }
}
