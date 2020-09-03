<?php 

namespace App\Repositories\MProduct;
use App\Repositories\Mproduct\IBarcodeRepository;
use App\Models\MProduct\Product;
use DNS1D;
use DataTables;

class BarcodeRepository implements IBarcodeRepository
{
    public function renderDataTable($products)
    {
        return Datatables::of($products)
            ->addColumn('barcode', function($products) 
            {
                return '    
                    <div id="print-side'.$products->p_id.'">

                        '.DNS1D::getBarcodeSVG($products->p_code, 'I25+').'

                    </div>
                ';
            })
            ->addColumn('actions', function($products) 
            {
                return 
                    '
                    <button id="'.$products->p_id.'" class="button-select-item button-s1 button-purple"><i class="fas fa-print mr-1"></i> Cetak Barcode</button>
                    ';
            })
            ->rawColumns(['barcode', 'actions'])
            ->make(true);
    }
}