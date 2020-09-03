<?php 

namespace App\Repositories\MBranch;
use App\Repositories\MBranch\IBranchProductRepository;
use App\Models\MBranch\Branch;
use App\Models\MProduct\Product;
use DataTables;
use Utilities;

class BranchProductRepository implements IBranchProductRepository
{
    public function renderDataTable($branches)
    {
        return Datatables::of($branches)
            ->editColumn('b_status', function($branches) 
            {   
                if($branches->b_status == 1)
                {
                    return 
                    '
                    <label class="switch" for="checkbox">
            
                        <input type="checkbox" name="status" id="checkbox'.$branches->b_id.'" checked/>
                    
                        <div class="slider round"></div>
                    
                    </label>
                    ';
                }
                else
                {
                    return 
                    '
                    <label class="switch" for="checkbox">
            
                        <input type="checkbox" name="status" id="checkbox'.$branches->b_id.'" />
                    
                        <div class="slider round"></div>
                    
                    </label>
                    ';
                }
            })
            ->addColumn('details', function($branches)
            {
                $details = '';

                foreach($branches->products as $product) {
                    $details .= 
                    '
                    <tr>

                        <td>'.$product->p_code.'</td>

                        <td>'.$product->p_name.'</td>

                        <td>'.Utilities::rupiahFormat($product->p_price).'</td>

                        <td>'.$product->category->cat_name.'</td>

                        <td>'.$product->unit->unit_name.'</td>

                        <td>'.Utilities::renderImage('products', $product->p_image).'</td>

                        <td>'.Utilities::statusFormat($product->p_status).'</td>
                    
                    </tr>
                    ';
                }
                return 
                    '
                    <button class="button-s1 button-brown mb-4" data-toggle="modal" data-target="#detModal'.$branches->b_id.'">
    					
                        Detail Produk

                    </button>

                    <div class="modal fade" id="detModal'.$branches->b_id.'" tabindex="-1" role="dialog" aria-hidden="true">
                            
                        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                        
                            <div class="modal-content">
                            
                                <div class="modal-header">
                            
                                    <h5 class="modal-title">Detail Produk <i class="fas fa-store ml-2"></i></h5>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        
                                        <span aria-hidden="true">&times;</span>
                                    
                                    </button>
                            
                                </div>
                            
                                <div class="modal-body">

                                    <table class="table table-hover">

                                        <thead>

                                            <th>Kode</th>

                                            <th>Produk</th>

                                            <th>Harga</th>

                                            <th>Kategori</th>

                                            <th>Satuan</th>

                                            <th>Gambar</th>

                                            <th>Status</th>

                                        </thead>

                                        <tbody>

                                            '.$details.'

                                        </tbody>

                                    </table>

                                </div>
                            
                            </div>

                        </div>

                    </div>
                    ';
            })
            ->addColumn('actions', function($branches) 
            {
                $token = csrf_token();

                return 
                    '
                    <div class="dropdown">
                        
                        <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            Aksi
                        
                        </button>

                        <div class="dropdown-menu mr-5" aria-labelledby="dropdownMenuLink">

                            <a class="dropdown-item text-warning" href="'.route("branch-product.edit", $branches->b_id).'">

                                <i class="fas fa-edit mr-1"></i> Edit

                            </a>
                        
                            <a class="dropdown-item text-danger" data-toggle="modal" data-target="#delModal'.$branches->b_id.'">

                                <i class="fas fa-trash mr-1"></i> Hapus

                            </a>
                        
                        </div>

                    </div>

                    <div class="modal fade" id="delModal'.$branches->b_id.'">
                                            
                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h4 class="modal-title">Aktifkan Produk <i class="fas fa-store ml-2"></i></h4>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                        <span aria-hidden="true">&times;</span>
                            
                                    </button>
                                
                                </div>

                                <form action="'.route('branch-product.destroy', $branches->b_id).'" method="POST">

                                    <input type="hidden" name="_token" value="'.$token.'" />

                                    <input type="hidden" name="_method" value="DELETE">

                                    <div class="modal-body">
                                
                                        Yakin ingin mengaktifkan produk ke cabang <b>'.$branches->b_name.'</b> ?
                            
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
            ->rawColumns(['b_status', 'details', 'actions'])
            ->make(true);
    }

    public function store($request)
    {
        $branch = Branch::find($request->b_id);

        if($request->products)
        {
            foreach($request->products as $product)
            {
                $branch->products()->attach($product['p_id']);
            }
        }
    }

    public function update($request)
    {
        $branch = Branch::find($request->b_id);

        if($request->products)
        {
            $data = [];

            foreach($request->products as $product)
            {
                $data[] = $product['p_id'];
            }

            $branch->products()->sync($data);
        }
        else
        {
            return $branch->products()->detach();
        }
    }
}