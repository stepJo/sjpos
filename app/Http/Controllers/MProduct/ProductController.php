<?php

namespace App\Http\Controllers\MProduct;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MProduct\CreateProductRequest;
use App\Http\Requests\MProduct\UpdateProductRequest;
use App\Exports\ProductsExport;
use App\Models\MProduct\Category;
use App\Models\MProduct\Product;
use App\Models\MProduct\Unit;
use \Cache;
use DataTables;
use DB;
use Excel;
use PDF;
use Utilities;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {   
            $products = Product::with('category', 'unit')->get();
            
            return Datatables::of($products)
                ->editColumn('p_price', function($products) 
                {
                    return Utilities::rupiahFormat($products->p_price);
                })
                ->editColumn('p_image', function($products) 
                {
                    return Utilities::renderImage('products', $products->p_image);
                })
                ->editColumn('p_status', function($products) 
                {   
                    $token = csrf_token();

                    if($products->p_status == 1)
                    {
                        return 
                        '
                        <label class="switch" for="checkbox">
                
                            <input type="checkbox" name="status" id="checkbox'.$products->p_id.'" checked/>
                        
                            <div class="slider round"></div>
                        
                        </label>
                        ';
                    }
                    else
                    {
                        return 
                        '
                        <label class="switch" for="checkbox">
                
                            <input type="checkbox" name="status" id="checkbox'.$products->p_id.'" />
                        
                            <div class="slider round"></div>
                        
                        </label>
                        ';
                    }
                })
                ->addColumn('actions', function($products) 
                {
                    $token = csrf_token();

                    $desc = $products->p_desc != null ? $products->p_desc : '-';

                    $price = Utilities::rupiahFormat($products->p_price);

                    $image = Utilities::renderImage('products', $products->p_image);

                    $status = Utilities::statusFormat($products->p_status);

                    return 
                        '
                        <div class="dropdown">
                            
                            <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                Aksi
                            
                            </button>

                            <div class="dropdown-menu mr-5" aria-labelledby="dropdownMenuLink">
                            
                                <a class="dropdown-item text-info" data-toggle="modal" data-target="#detModal'.$products->p_id.'">

                                    <i class="fas fa-info-circle mr-1"></i> Detail

                                </a>
                            
                                <a class="dropdown-item text-warning" href="'.route("product.edit", $products->p_id).'">

                                    <i class="fas fa-edit mr-1"></i> Edit

                                </a>
                            
                                <a class="dropdown-item text-danger" data-toggle="modal" data-target="#delModal'.$products->p_id.'">

                                    <i class="fas fa-trash mr-1"></i> Delete

                                </a>
                            
                            </div>

                        </div>

                        <div class="modal fade" id="detModal'.$products->p_id.'" tabindex="-1" role="dialog" aria-hidden="true">
                          
                            <div class="modal-dialog" role="document">
                            
                                <div class="modal-content">
                              
                                    <div class="modal-header">
                                
                                        <h5 class="modal-title">Detail Produk <i class="fas fa-box-open ml-2"></i></h5>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          
                                            <span aria-hidden="true">&times;</span>
                                        
                                        </button>
                              
                                    </div>
                              
                                    <div class="modal-body">

                                        <div class="row">

                                            <div class="col-md-6">

                                                <h6>Kode</h6>

                                                <span class="font-weight-bold">'.$products->p_code.'</span>

                                                <h6 class="mt-3">Kategori</h6>

                                                <span class="font-weight-bold">'.$products->category->cat_name.'</span>

                                                <h6 class="mt-3">Satuan</h6>

                                                <span class="font-weight-bold">'.$products->unit->unit_name.'</span>

                                                <h6 class="mt-3">Harga</h6>

                                                <span class="font-weight-bold">'.$price.'</span>

                                                <h6 class="mt-3">Status</h6>

                                                '.$status.'

                                            </div>

                                            <div class="col-md-6">

                                                <h6>Gambar</h6>

                                                '.$image.'

                                                <h6 class="mt-3">Nama</h6>

                                                <span class="font-weight-bold">'.$products->p_name.'</span>

                                                <h6 class="mt-3">Deskripsi</h6>

                                                <span class="font-weight-bold font-italic">'.$desc.'</span>

                                            </div>

                                        </div>
                                        
                                    </div>
                              
                                </div>

                            </div>

                        </div>

                        <div class="modal fade" id="delModal'.$products->p_id.'">
                                                
                            <div class="modal-dialog">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h4 class="modal-title">Hapus Produk</h4>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                <span aria-hidden="true">&times;</span>
                                    
                                            </button>
                                        
                                    </div>

                                    <form action="'.route('product.destroy', $products->p_id).'" method="POST">

                                        <input type="hidden" name="_token" value="'.$token.'" />

                                        <input type="hidden" name="_method" value="DELETE">

                                        <div class="modal-body">
                                    
                                            Yakin ingin menghapus kategori <b>'.$products->p_name.'</b> ?
                                
                                        </div>
                                    
                                        <div class="modal-footer justify-content-between">
                                      
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                      
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        
                                        </div>

                                    </form>
                              
                                </div>
                            
                            </div>
                          
                        </div>';
                })
                ->rawColumns(['p_code', 'p_image', 'p_status', 'actions'])
                ->make(true);
        }

        return view('m_product.p_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $units = Unit::all();

        return view('m_product.p_a' ,compact('categories', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {   
        $image = Utilities::moveImage($request, 'products');

        Product::create([
            'p_code'   => $request->p_code,
            'cat_id'   => $request->cat_id,
            'p_name'   => $request->p_name,
            'p_desc'   => $request->p_desc,
            'unit_id'  => $request->unit_id,
            'p_price'  => $request->p_price,
            'p_image'  => $image,
            'p_status' => $request->p_status
        ]);

        return redirect('product')->with('success', 'Berhasil tambah produk');
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
    public function edit(Product $product)
    {
        $categories = Category::all();
        $units = Unit::all();

        return view('m_product.p_e' ,compact('product', 'categories', 'units'));
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
        $product = Product::findorFail($id);

        $product->update($request->validated());

        if($request->hasfile('p_image'))
        {
            $image = Utilities::moveImage($request, 'products');

            $product->p_image = $image;

            $product->save();
        }

        return redirect('product')->with('success', 'Berhasil ubah produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->back()->with('success', 'Berhasil hapus produk');
    }

    public function exportCSV()
    {
        return Excel::download(new ProductsExport, 'Data_Produk_'.date('d_F_Y').'.csv');
    }

    public function exportExcel()
    {
        return Excel::download(new ProductsExport, 'Data_Produk_'.date('d_F_Y').'.xlsx');
    }

    public function exportPDF()
    {
        $products = Product::with('category', 'unit')->get();



        $pdf = PDF::loadView('m_product.p_pdf', compact('products'));

        return $pdf->stream('Data_Produk_'.date('d_F_Y').'.pdf');
    }
}
