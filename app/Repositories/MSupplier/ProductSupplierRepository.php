<?php 

namespace App\Repositories\MSupplier;
use App\Repositories\MSupplier\IProductSupplierRepository;
use App\Exports\MSupplier\ProductSupplierExport;
use App\Models\MSupplier\ProductSupplier;
use DataTables;
use Excel;
use PDF;
use Roles;
use Utilities;

class ProductSupplierRepository implements IProductSupplierRepository
{
    public function renderDataTable($request, $suppliers, $access)
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
                ->addColumn('actions', function($products) use($suppliers, $access) 
                {
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

                    $token = csrf_token();

                    $price = Utilities::rupiahFormat($products->ps_price);

                    $desc = Utilities::emptyFormat($products->ps_desc);
                    
                    if($access->edit != 1 && $access->delete != 1)
                    {
                        $html = Roles::noAccess();
                    }
                    else
                    {
                        $edit_dropdown = '';

                        if($access->edit == 1)
                        {
                            $edit_dropdown =
                                '
                                <a class="dropdown-item text-warning" data-toggle="modal" data-target="#editModal'.$products->ps_id.'">

                                    <i class="fas fa-edit mr-1"></i> Edit

                                </a>
                                ';
                        }
                        
                        $delete_dropdown = '';

                        if($access->delete == 1)
                        {
                            $delete_dropdown =
                                '
                                <a class="dropdown-item text-danger" data-toggle="modal" data-target="#delModal'.$products->ps_id.'">

                                    <i class="fas fa-trash mr-1"></i> Hapus

                                </a>
                                ';
                        }

                        $html =
                            '
                            <div class="dropdown">
                                
                                <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                    Aksi
                                
                                </button>

                                <div class="dropdown-menu mr-5" aria-labelledby="dropdownMenuLink">
                                
                                    '.$edit_dropdown.'
                                
                                    '.$delete_dropdown.'    
                                
                                </div>

                            </div>
                            ';

                        if($access->edit == 1)
                        {
                            $html .=
                                '
                                <div class="modal fade" id="editModal'.$products->ps_id.'">
                                                
                                    <div class="modal-dialog modal-lg">

                                        <div class="modal-content">

                                        <div class="modal-header">

                                            <h4 class="modal-title">Edit Barang <i class="nav-icon fas fa-truck ml-2"></i></h4>

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

                                                                <label class="modal-label">Deskripsi</label>

                                                                <br/>

                                                                <span class="text-danger edit-ps-desc-address-error"></span>

                                                                <textarea class="textarea-input edit-ps-desc-modal-error" name="ps_desc">'.$products->ps_desc.'</textarea>
                                                        
                                                            </div>

                                                        </div>

                                                    </div>		
                                            
                                                </div>
                                            
                                                <div class="modal-footer justify-content-between">
                                                
                                                    <button type="button" class="button-s1 button-grey" data-dismiss="modal">Batal</button>
                                                
                                                    <button type="submit" class="button-s1 button-yellow">Ubah</button>
                                                
                                                </div>

                                            </form>
                                        
                                        </div>
                                    
                                    </div>
                                    
                                </div>
                                ';
                        }

                        if($access->delete == 1)
                        {   
                            $html .=
                                '
                                <div class="modal fade" id="delModal'.$products->ps_id.'">
                                                        
                                    <div class="modal-dialog">

                                        <div class="modal-content">

                                            <div class="modal-header">

                                                <h4 class="modal-title">Hapus Barang <i class="nav-icon fas fa-truck ml-2"></i></h4>

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
                                
                                </div>
                                ';
                        }
                    }
                    
                    return $html;
                })
                ->rawColumns(['actions'])
                ->make(true);
    }
    
    public function store($request)
    {
        return ProductSupplier::create($request->validated());
    }

    public function update($request, $product)
    {
        return $product->update($request->validated());
    }

    public function destroy($product)
    {
        return $product->delete();
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