<?php 

namespace App\Repositories\MProduct;
use App\Repositories\Mproduct\ICategoryRepository;
use App\Models\MProduct\Category;

class CategoryRepository implements ICategoryRepository
{
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

    public function search($request)
    {
        return Category::with('products', 'discounts')->find($request->cat_id);
    }
}