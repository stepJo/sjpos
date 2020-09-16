<?php 

namespace App\Repositories\MBranch;

use App\Repositories\MBranch\IBranchRepository;
use App\Exports\MBranch\BranchExport;
use App\Models\MBranch\Branch;
use DataTables;
use Excel;
use PDF;
use Utilities;

class BranchRepository implements IBranchRepository
{
    public function renderDataTable($access)
    {
        $branches = Branch::all();
            
        return Datatables::of($branches)
            ->editColumn('b_desc', function($branches)
            {   
                return Utilities::emptyFormat($branches->b_desc);
            })
            ->editColumn('b_address', function($branches)
            {   
                return Utilities::emptyFormat($branches->b_address);
            })
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
            ->addColumn('actions', function($branches) use($access) 
            {
                $token = csrf_token();

                $status_list = "";

                if($branches->b_status == 1)
                {
                    $status_list.= '
                        <option value="1" class="font-weight-bold text-success" selected>Aktif</option>
                        <option value="0" class="font-weight-bold text-danger">Tidak Aktif</option>
                    ';
                }
                else
                {
                    $status_list.= '
                        <option value="1" class="font-weight-bold text-success">Aktif</option>
                        <option value="0" class="font-weight-bold text-danger" selected>Tidak Aktif</option>
                    ';
                }

                $desc = Utilities::emptyFormat($branches->b_desc);

                $address = Utilities::emptyFormat($branches->b_address);

                $status = Utilities::statusFormat($branches->b_status);

                $edit_dropdown = '';

                if($access->edit == 1)
                {
                    $edit_dropdown = 
                        '
                        <a class="dropdown-item text-warning" data-toggle="modal" data-target="#editModal'.$branches->b_id.'">

                            <i class="fas fa-edit mr-1"></i> Edit

                        </a>
                        ';
                }

                $delete_dropdown = '';
                
                if($access->delete == 1)
                {
                    $delete_dropdown =
                        '<a class="dropdown-item text-danger" data-toggle="modal" data-target="#delModal'.$branches->b_id.'">

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
                        
                            <a class="dropdown-item text-info" data-toggle="modal" data-target="#detModal'.$branches->b_id.'">

                                <i class="fas fa-info-circle mr-1"></i> Detail

                            </a>
                        
                            '.$edit_dropdown.'
                        
                            '.$delete_dropdown.'    
                        
                        </div>

                    </div>

                    <div class="modal fade" id="detModal'.$branches->b_id.'" tabindex="-1" role="dialog" aria-hidden="true">
                        
                        <div class="modal-dialog modal-lg" role="document">
                        
                            <div class="modal-content">
                            
                                <div class="modal-header">
                            
                                    <h5 class="modal-title">Detail Cabang <i class="fas fa-store ml-2"></i></h5>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        
                                        <span aria-hidden="true">&times;</span>
                                    
                                    </button>
                            
                                </div>
                            
                                <div class="modal-body">

                                    <div class="row">

                                        <div class="col-md-6">

                                            <h6>Kode</h6>

                                            <span class="font-weight-bold">'.$branches->b_code.'</span>

                                            <h6 class="mt-3">Email</h6>

                                            <span class="font-weight-bold">'.$branches->b_name.'</span>

                                            <h6 class="mt-3">Deskripsi</h6>

                                            <span class="font-weight-bold">'.$desc.'</span>

                                            <h6 class="mt-3">Status</h6>

                                            '.$status.'

                                        </div>

                                        <div class="col-md-6">

                                            <h6>Nama</h6>

                                            <span class="font-weight-bold">'.$branches->b_name.'</span>

                                            <h6 class="mt-3">Kontak</h6>

                                            <span class="font-weight-bold">'.$branches->b_contact.'</span>

                                            <h6 class="mt-3">Alamat</h6>

                                            <span class="font-weight-bold">'.$address.'</span>

                                        </div>

                                    </div>
                                    
                                </div>
                            
                            </div>

                        </div>

                    </div>
                    ';

                if($access->edit == 1)
                {
                    $html .=
                        '
                        <div class="modal fade" id="editModal'.$branches->b_id.'">
                                        
                            <div class="modal-dialog modal-lg">

                                <div class="modal-content">

                                <div class="modal-header">

                                    <h4 class="modal-title">Edit Cabang <i class="fas fa-store ml-2"></i></h4>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                        <span aria-hidden="true">&times;</span>
                                    
                                    </button>
                                        
                                    </div>

                                    <form class="edit-branch-form" data-id="'.$branches->b_id.'">

                                        <input type="hidden" name="_token" value="'.$token.'" />

                                        <input type="hidden" name="_method" value="PATCH">

                                        <div class="modal-body">

                                            <p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>

                                            <div class="row">

                                                <div class="col-md-6">

                                                    <div class="form-group">

                                                        <label class="modal-label">Kode *</label>

                                                        <br/>

                                                        <span class="text-danger edit-b-code-error"></span>

                                                        <input 
                                                            type="text" 
                                                            name="b_code" 
                                                            class="modal-input edit-b-code-modal-error" 
                                                            value="'.$branches->b_code.'"
                                                        > 

                                                    </div>

                                                    <div class="form-group">

                                                        <label class="modal-label">Email *</label>

                                                        <br/>

                                                        <span class="text-danger edit-b-email-error"></span>

                                                        <input 
                                                            type="email" 
                                                            name="b_email" 
                                                            class="modal-input edit-b-email-modal-error" 
                                                            value="'.$branches->b_email.'"
                                                        > 

                                                    </div>

                                                    <div class="form-group">

                                                        <label class="modal-label">Deskripsi</label>

                                                        <br/>

                                                        <span class="text-danger edit-b-desc--error"></span>

                                                        <textarea class="textarea-input edit-b-desc-modal-error" name="b_desc">'.$branches->b_desc.'</textarea>
                                                
                                                    </div>

                                                    <div class="form-group">

                                                        <label class="modal-label">Status *</label>

                                                        <br/>

                                                        <span class="text-danger edit-b-status-error"></span>

                                                        <select class="form-control modal-input select2bs4 edit-b-status-modal-error" style="width: 100%;" name="b_status">

                                                            '.$status_list.'

                                                        </select>

                                                    </div>

                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group">

                                                        <label class="modal-label">Nama *</label>

                                                        <br/>

                                                        <span class="text-danger edit-b-name-error"></span>

                                                        <input 
                                                            type="text" 
                                                            name="b_name" 
                                                            class="modal-input edit-b-name-modal-error" 
                                                            value="'.$branches->b_name.'"
                                                        > 

                                                    </div>

                                                    <div class="form-group">

                                                        <label class="modal-label">Kontak *</label>

                                                        <br/>

                                                        <span class="text-danger edit-b-contact-error"></span>

                                                        <input 
                                                            type="text" 
                                                            name="b_contact" 
                                                            class="modal-input edit-b-contact-modal-error" 
                                                            value="'.$branches->b_contact.'"
                                                        > 

                                                    </div>

                                                    <div class="form-group">

                                                        <label class="modal-label">Alamat</label>

                                                        <br/>

                                                        <span class="text-danger edit-b-address-error"></span>

                                                        <textarea class="textarea-input edit-b-address-modal-error" name="b_address">'.$branches->b_address.'</textarea>
                                                
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
                    <div class="modal fade" id="delModal'.$branches->b_id.'">
                                            
                        <div class="modal-dialog">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h4 class="modal-title">Hapus Cabang <i class="fas fa-store ml-2"></i></h4>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                        <span aria-hidden="true">&times;</span>
                            
                                    </button>
                                    
                                </div>

                                <form action="'.route('branch.destroy', $branches->b_id).'" method="POST">

                                    <input type="hidden" name="_token" value="'.$token.'" />

                                    <input type="hidden" name="_method" value="DELETE">

                                    <div class="modal-body">
                                
                                        Yakin ingin menghapus cabang <b>'.$branches->b_name.'</b> ?
                            
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

                return $html;
            })
            ->rawColumns(['b_status', 'actions'])
            ->make(true);
    }

    public function store($request)
    {
        return Branch::create($request->validated());
    }

    public function update($request, $branch)
    {
        return $branch->update($request->validated());
    }

    public function destroy($branch)
    {
        return $branch->delete();
    }

    public function exportCSV()
    {
        return Excel::download(new BranchExport, 'Data_Produk_'.date('d_F_Y').'.csv');
    }

    public function exportExcel()
    {
        return Excel::download(new BranchExport, 'Data_Produk_'.date('d_F_Y').'.xlsx');
    }

    public function exportPDF()
    {
        $branches = Branch::all();
        
        $pdf = PDF::loadView('mbranch.b_pdf', compact('branches'));

        return $pdf->stream('Data_Cabang_'.date('d_F_Y').'.pdf');
    }
}