<?php 

namespace App\Repositories\MProduct;
use App\Repositories\Mproduct\ICategoryRepository;
use App\Models\MProduct\Category;

class CategoryRepository implements ICategoryRepository
{
    public function all()
    {
        return Category::with('products')->get(['cat_id', 'cat_name']);
    }

    public function store($request)
    {
        return Category::create($request->validated());
    }

    public function update($request, $category)
    {
        return $category->update($request->validated());
    }

    public function destroy($category)
    {
        $category->delete();
    }
}