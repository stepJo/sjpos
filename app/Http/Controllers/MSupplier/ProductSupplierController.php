<?php

namespace App\Http\Controllers\MSupplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MSupplier\CreateProductSupplierRequest;
use App\Http\Requests\MSupplier\UpdateProductSupplierRequest;
use App\Exports\ProductSupplierExport;
use App\Models\MSupplier\ProductSupplier;
use App\Models\MSupplier\Supplier;
use DataTables;
use Excel;
use PDF;
use Utilities;

class ProductSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $suppliers = Supplier::select('s_id', 's_name')->get();

        if($request->ajax())
        {
            if(!empty($request->start_date))
            {
                $products = ProductSupplier::with('supplier')->whereBetween('created_at', [$request->start_date, $request->end_date])->get(); 
            }
            else 
            {
                $products = ProductSupplier::with('supplier')->orderByDesc('created_at')->get();
            }

            return Datatables::of($products)
                ->editColumn('ps_price', function($products) 
                {
                    return Utilities::rupiahFormat($products->ps_price);
                })
                ->editColumn('ps_desc', function($products) {
                    return Utilities::emptyFormat($products->ps_desc);
                })
                ->addColumn('actions', function($products) use($suppliers) 
                {
                    $token = csrf_token();

                    $price = Utilities::rupiahFormat($products->ps_price);

                    $desc = $products->ps_desc != null ? $products->ps_desc : '-';

                    $supplier_list = "";

                    foreach($suppliers as $supplier)
                    {
                        if($supplier->s_id == $products->s_id)
                        {
                            $supplier_list.= '<option value="'.$supplier->s_id.'" selected>'.$supplier->s_name.'</option>';
                        }
                        else
                        {
                            $supplier_list.= '<option value="'.$supplier->s_id.'">'.$supplier->s_name.'</option>';
                        }
                    }
                    
                    return 
                        '
                        <div class="dropdown">
                            
                            <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                Aksi
                            
                            </button>

                            <div class="dropdown-menu mr-5" aria-labelledby="dropdownMenuLink">
                            
                                <a class="dropdown-item text-warning" data-toggle="modal" data-target="#editModal'.$products->ps_id.'">

                                    <i class="fas fa-edit mr-1"></i> Edit

                                </a>
                            
                                <a class="dropdown-item text-danger" data-toggle="modal" data-target="#delModal'.$products->ps_id.'">

                                    <i class="fas fa-trash mr-1"></i> Hapus

                                </a>
                            
                            </div>

                        </div>

                        <div class="modal fade" id="editModal'.$products->ps_id.'">
								        
                            <div class="modal-dialog modal-lg">

                                <div class="modal-content">

                                <div class="modal-header">

                                    <h4 class="modal-title">Edit Barang</h4>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                        <span aria-hidden="true">&times;</span>
                                    
                                    </button>
                                        
                                    </div>

                                    <form class="edit-product-supplier-form" data-id="'.$products->ps_id.'">

                                        <input type="hidden" name="_token" value="'.$token.'" />

                                        <input type="hidden" name="_method" value="PATCH">

                                        <div class="modal-body">

                                            <p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>

                                            <div class="row">

                                                <div class="col-md-6">

                                                    <div class="form-group">

                                                        <label class="modal-label">Nama *</label>

                                                        <br/>

                                                        <span class="text-danger edit-ps-name-error"></span>

                                                        <input 
                                                            type="text" 
                                                            name="ps_name" 
                                                            class="modal-input edit-ps-name-modal-error" 
                                                            value="'.$products->ps_name.'"
                                                        > 

                                                    </div>

                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group">

                                                        <label class="modal-label">Kode *</label>

                                                        <br/>

                                                        <span class="text-danger edit-ps-code-error"></span>

                                                        <input 
                                                            type="text" 
                                                            name="ps_code" 
                                                            class="modal-input edit-ps-code-modal-error" 
                                                            value="'.$products->ps_code.'"
                                                        > 

                                                    </div>

                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group">

                                                        <label class="modal-label">Harga *</label>

                                                        <br/>

                                                        <span class="text-danger edit-ps-price-error"></span>

                                                        <input 
                                                            type="text" 
                                                            name="ps_price" 
                                                            class="modal-input edit-ps-price-modal-error" 
                                                            value="'.$products->ps_price.'"
                                                        > 

                                                    </div>

                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group">

                                                        <label class="modal-label">Penyuplai *</label>

                                                        <br/>

                                                        <span class="text-danger edit-s-id-error"></span>

                                                        <select class="form-control modal-input select2bs4 edit-s-id-modal-error" style="width: 100%;" name="s_id">

                                                            '.$supplier_list.'

                                                        </select>

                                                    </div>
                                                    
                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group">

                                                        <label for="ps_desc">Deskripsi</label>

                                                        <br/>

                                                        <span class="text-danger edit-ps-desc-address-error"></span>

                                                        <textarea class="textarea-input edit-ps-desc-modal-error" name="ps_desc">'.$products->ps_desc.'</textarea>
                                                
                                                    </div>

                                                </div>

                                            </div>		
                                    
                                        </div>
                                    
                                        <div class="modal-footer justify-content-between">
                                        
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                        
                                            <button type="submit" class="btn btn-warning">Ubah</button>
                                        
                                        </div>

                                    </form>
                                
                                </div>
                            
                            </div>
                            
                        </div>

                        <div class="modal fade" id="delModal'.$products->ps_id.'">
                                                
                            <div class="modal-dialog">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h4 class="modal-title">Hapus Barang</h4>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                <span aria-hidden="true">&times;</span>
                                    
                                            </button>
                                        
                                    </div>

                                    <form action="'.route('product-supplier.destroy', $products->ps_id).'" method="POST">

                                        <input type="hidden" name="_token" value="'.$token.'" />

                                        <input type="hidden" name="_method" value="DELETE">

                                        <div class="modal-body">
                                    
                                            Yakin ingin menghapus barang <b>'.$products->ps_name.'</b> ?
                                
                                        </div>
                                    
                                        <div class="modal-footer justify-content-between">
                                      
                                            <button type="button" class="button-s1 button-grey" data-dismiss="modal">Batal</button>
                                      
                                            <button type="submit" class="button-s1 button-red">Hapus</button>
                                        
                                        </div>

                                    </form>
                              
                                </div>
                            
                            </div>
                          
                        </div>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('msupplier/p_s_index', compact('suppliers'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductSupplierRequest $request)
    {
        ProductSupplier::create($request->validated());

        return response()->json([
            'message' => 'Berhasil tambah barang'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductSupplierRequest $request, ProductSupplier $product)
    {
        $product->update($request->validated());
        
        return response()->json([
            'message' => 'Berhasil ubah barang'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductSupplier $product)
    {
        $product->delete();

        return redirect()->back()->with('success', 'Berhasil hapus barang');
    }

    public function exportCSV()
    {
        return Excel::download(new ProductSupplierExport, 'Data_Suplai_Barang_'.date('d_F_Y').'.csv');
    }

    public function exportExcel()
    {
        return Excel::download(new ProductSupplierExport, 'Data_Suplai_Barang_'.date('d_F_Y').'.xlsx');
    }

    public function exportPDF()
    {
        $products = ProductSupplier::with('supplier')->get();
        
        $pdf = PDF::loadView('msupplier.p_s_pdf', compact('products'));

        return $pdf->stream('Data_Suplai_Barang_'.date('d_F_Y').'.pdf');
    }
}
