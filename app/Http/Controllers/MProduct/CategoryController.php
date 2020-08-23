<?php

namespace App\Http\Controllers\MProduct;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MProduct\CreateCategoryRequest;
use App\Http\Requests\MProduct\UpdateCategoryRequest;
use App\Repositories\MProduct\ICategoryRepository;
use App\Models\MProduct\Category;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(ICategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->all();

        return view('mproduct.c_index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $this->categoryRepository->store($request);

        return response()->json([
            'message' => 'Berhasil tambah kategori'
        ]);
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
        $this->categoryRepository->update($request, $category);
        
        return response()->json([
            'message' => 'Berhasil ubah kategori'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->categoryRepository->destroy($category);

        return redirect()->back()->with('success', 'Berhasil hapus kategori');
    }
}
