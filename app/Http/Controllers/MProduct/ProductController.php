<?php

namespace App\Http\Controllers\MProduct;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Policies\MProduct\ProductPolicy;
use App\Http\Requests\MProduct\CreateProductRequest;
use App\Http\Requests\MProduct\UpdateProductRequest;
use App\Repositories\MProduct\IProductRepository;
use App\Services\MUserService;
use App\Models\MProduct\Category;
use App\Models\MProduct\Unit;
use App\Models\MProduct\Product;

class ProductController extends Controller
{
    private $productPolicy;
    private $productRepository;
    private $userService;

    public function __construct(
        ProductPolicy $productPolicy,
        IProductRepository $productRepository, 
        MUserService $userService
    )
    {
        $this->productPolicy = $productPolicy;
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
        $access = $this->productPolicy->access();

        if($access->view != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk lihat produk');
        }
        else
        {
            if($request->ajax())
            {
                return $this->productRepository->renderDataTable($access);
            }
            
            $views = $this->userService->menusRole();

            return view('mproduct.p_index', compact('access', 'views'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $access = $this->productPolicy->access();

        if($access->add != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk tambah produk');
        }
        else
        {
            $categories = Category::all();
            $units = Unit::all();

            $views = $this->userService->menusRole();

            return view('mproduct.p_a' ,compact('categories', 'units', 'access', 'views'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {   
        $access = $this->productPolicy->access();

        if($access->add != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk tambah produk');;
        }
        else
        {
            $this->productRepository->store($request);

            return redirect('product')->with('success', 'Berhasil tambah produk');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $access = $this->productPolicy->access();

        if($access->edit != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk ubah produk');
        }
        else
        {
            $categories = Category::all();
            $units = Unit::all();

            $views = $this->userService->menusRole();

            return view('mproduct.p_e' ,compact('product', 'categories', 'units', 'views'));
        }
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
        $access = $this->productPolicy->access();

        if($access->edit != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk ubah produk');
        }
        else
        {
            $this->productRepository->update($request, $id);

            return redirect('product')->with('success', 'Berhasil ubah produk');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $access = $this->productPolicy->access();

        if($access->delete != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk hapus produk');
        }
        else
        {
            $this->productRepository->destroy($product);

            return redirect()->back()->with('success', 'Berhasil hapus produk');
        }
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
