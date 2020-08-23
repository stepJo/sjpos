<?php 

namespace App\Repositories\MProduct;
use App\Repositories\Mproduct\IUnitRepository;
use App\Models\MProduct\Unit;

class UnitRepository implements IUnitRepository
{
    public function all()
    {
        return Unit::with('products')->get(['unit_id', 'unit_name']);
    }

    public function store($request)
    {
        return Unit::create($request->validated());
    }

    public function update($request, $unit)
    {
        return $unit->update($request->validated());
    }

    public function destroy($unit)
    {
        $unit->delete();
    }
}