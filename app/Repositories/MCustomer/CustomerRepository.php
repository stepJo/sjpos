<?php 

namespace App\Repositories\MCustomer;
use App\Repositories\MCustomer\ICustomerRepository;
use App\Models\MCustomer\Customer;
use DataTables;
use Excel;
use PDF;
use Utilities;

class CustomerRepository implements ICustomerRepository
{
    public function renderDataTable($access)
    {
        $customers = Customer::all();
            
        return Datatables::of($customers)
            ->editColumn('c_email', function($customers)
            {   
                return Utilities::emptyFormat($customers->c_email);
            })
            ->editColumn('c_contact', function($customers)
            {   
                return Utilities::emptyFormat($customers->c_contact);
            })
            ->editColumn('c_address', function($customers)
            {   
                return Utilities::emptyFormat($customers->c_address);
            })
            ->addColumn('actions', function($customers) use($access) 
            {
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
                            <a class="dropdown-item text-warning" data-toggle="modal" data-target="#editModal'.$customers->c_id.'">

                                <i class="fas fa-edit mr-1"></i> Edit

                            </a>
                            ';
                    }

                    $delete_dropdown = '';
                    
                    if($access->delete == 1)
                    {
                        $delete_dropdown =
                            '<a class="dropdown-item text-danger" data-toggle="modal" data-target="#delModal'.$customers->c_id.'">

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

                    $token = csrf_token();

                    if($access->edit == 1)
                    {
                        $html .=
                            '
                            <div class="modal fade" id="editModal'.$customers->c_id.'">
                                            
                                <div class="modal-dialog">

                                    <div class="modal-content">

                                    <div class="modal-header">

                                        <h4 class="modal-title">Edit Pelanggan <i class="far fa-grin ml-2"></i></h4>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                            <span aria-hidden="true">&times;</span>
                                        
                                        </button>
                                            
                                        </div>

                                        <form class="edit-customer-form" data-id="'.$customers->c_id.'">

                                            <input type="hidden" name="_token" value="'.$token.'" />

                                            <input type="hidden" name="_method" value="PATCH">

                                            <div class="modal-body">

                                                <p class="text-secondary font-weight-bold">[*] Wajib Diisi</p>

                                                <div class="row">

                                                    <div class="col-md-12">

                                                        <div class="form-group">

                                                            <label class="modal-label">Nama *</label>

                                                            <br/>

                                                            <span class="text-danger edit-c-name-error"></span>

                                                            <input 
                                                                type="text" 
                                                                name="c_name" 
                                                                class="modal-input edit-c-name-modal-error" 
                                                                value="'.$customers->c_name.'"
                                                            > 

                                                        </div>

                                                        <div class="form-group">

                                                            <label class="modal-label">Email</label>

                                                            <br/>

                                                            <span class="text-danger edit-c-email-error"></span>

                                                            <input 
                                                                type="email" 
                                                                name="c_email" 
                                                                class="modal-input edit-c-email-modal-error" 
                                                                value="'.$customers->c_email.'"
                                                            > 

                                                        </div>

                                                        <div class="form-group">

                                                            <label class="modal-label">Kontak</label>

                                                            <br/>

                                                            <span class="text-danger edit-c-contact-error"></span>

                                                            <input 
                                                                type="text" 
                                                                name="c_name" 
                                                                class="modal-input edit-c-contact-modal-error" 
                                                                value="'.$customers->c_contact.'"
                                                            > 

                                                        </div>

                                                        <div class="form-group">

                                                            <label class="modal-label">Alamat</label>

                                                            <br/>

                                                            <span class="text-danger edit-c-address-error"></span>

                                                            <textarea class="textarea-input edit-c-address-modal-error" name="c_address">'.$customers->c_address.'</textarea>
                                                    
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
                        <div class="modal fade" id="delModal'.$customers->c_id.'">
                                                
                            <div class="modal-dialog">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h4 class="modal-title">Hapus Pelanggan <i class="far fa-grin ml-2"></i></h4>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                            <span aria-hidden="true">&times;</span>
                                
                                        </button>
                                        
                                    </div>

                                    <form action="'.route('customer.destroy', $customers->c_id).'" method="POST">

                                        <input type="hidden" name="_token" value="'.$token.'" />

                                        <input type="hidden" name="_method" value="DELETE">

                                        <div class="modal-body">
                                    
                                            Yakin ingin menghapus pelanggan <b>'.$customers->c_name.'</b> ?
                                
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
        $customer = Customer::create($request->validated());

        return $customer;
    }

    public function update($request, $customer)
    {
        return $customer->update($request->validated());
    }

    public function destroy($customer)
    {
        $customer->delete();
    }

    public function exportCSV()
    {
        return Excel::download(new CustomerExport, 'Data_Pelanggan_'.date('d_F_Y').'.csv');
    }

    public function exportExcel()
    {
        return Excel::download(new CustomerExport, 'Data_Pelanggan_'.date('d_F_Y').'.xlsx');
    }

    public function exportPDF()
    {
        $customers = Customer::all();
        
        $pdf = PDF::loadView('mcustomer.c_pdf', compact('customers'));

        return $pdf->stream('Data_Pelanggan_'.date('d_F_Y').'.pdf');
    }
}