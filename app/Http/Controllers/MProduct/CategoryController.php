<?php

namespace App\Http\Controllers\MProduct;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Policies\MProduct\CategoryPolicy;
use App\Http\Requests\MProduct\CreateCategoryRequest;
use App\Http\Requests\MProduct\UpdateCategoryRequest;
use App\Repositories\MProduct\ICategoryRepository;
use App\Services\MProductService;
use App\Services\MUserService;
use App\Models\MProduct\Category;

class CategoryController extends Controller
{
    private $categoryPolicy;
    private $categoryRepository;
    private $productService;
    private $userService;

    public function __construct(
        CategoryPolicy $categoryPolicy,
        ICategoryRepository $categoryRepository, 
        MUserService $userService, 
        MProductService $productService
    )
    {
        $this->categoryPolicy = $categoryPolicy;
        $this->categoryRepository = $categoryRepository;
        $this->productService = $productService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $access = $this->categoryPolicy->access();

        if($access->view != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk lihat kategori');
        }
        else
        {
            $categories = $this->productService->categoriesProducts();

            $views = $this->userService->menusRole();

            return view('mproduct.c_index', compact('categories', 'access', 'views'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $access = $this->categoryPolicy->access();

        if($access->add != 1)
        {
            return response()->json([
                'status' => 'Fail',
                'message' => 'Tidak memiliki hak untuk tambah kategori'
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'Success',
                'message' => 'Berhasil tambah kategori'
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
    public function update(UpdateCategoryRequest $request, Category $category)
    {   
        $access = $this->categoryPolicy->access();

        if($access->edit != 1)
        {
            return response()->json([
                'status' => 'Fail',
                'message' => 'Tidak memiliki hak untuk ubah kategori'
            ]);
        }
        else
        {
            $this->categoryRepository->update($request, $category);
        
            return response()->json([
                'status' => 'Success',
                'message' => 'Berhasil ubah kategori'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $access = $this->categoryPolicy->access();

        if($access->delete != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk hapus kategori');
        }
        else
        {
            $this->categoryRepository->destroy($category);

            return redirect()->back()->with('success', 'Berhasil hapus kategori');
        }
    }
}
