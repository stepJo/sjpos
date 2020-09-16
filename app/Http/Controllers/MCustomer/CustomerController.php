<?php

namespace App\Http\Controllers\MCustomer;

use App\Http\Controllers\Controller;
use App\Policies\MCustomer\CustomerPolicy;
use Illuminate\Http\Request;
use App\Http\Requests\MCustomer\CustomerRequest;
use App\Repositories\MCustomer\ICustomerRepository;
use App\Services\MUserService;
use App\Models\MCustomer\Customer;

class CustomerController extends Controller
{
    private $customerPolicy;
    private $customerRepository;
    private $userService;

    public function __construct(
        CustomerPolicy $customerPolicy,
        ICustomerRepository $customerRepository,
        MUserService $userService
    )
    {
        $this->customerPolicy = $customerPolicy;
        $this->customerRepository = $customerRepository;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $access = $this->customerPolicy->access();

        if($access->view != 1)
        {
            return redirect('dashboard')->with('fail', 'Tidak memiliki hak untuk melihat pelanggan');
        }
        else
        {
            if($request->ajax())
            {
                return $this->customerRepository->renderDataTable($access);
            }

            $views = $this->userService->menusRole();

            return view('mcustomer.c_index', compact('access', 'views'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $access = $this->customerPolicy->access();

        if($access->add != 1)
        {
            return response()->json([
                'status'  => 'Fail',
                'message' => 'Tidak memiliki hak untuk tambah pelanggan'
            ]);
        }
        else
        {
            $this->customerRepository->store($request);

            return response()->json([
                'status'  => 'Success',
                'message' => 'Berhasil tambah pelanggan'
            ]);
        }
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $customer)
    {   
        $access = $this->customerPolicy->access();

        if($access->edit != 1)
        {
            return response()->json([
                'status'  => 'Fail',
                'message' => 'Tidak memiliki hak untuk ubah pelanggan'
            ]);
        }
        else
        {
            $this->customerRepository->update($request, $customer);
            
            return response()->json([
                'status'  => 'Success',
                'message' => 'Berhasil ubah pelanggan'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $access = $this->customerPolicy->access();

        if($access->delete != 1)
        {
            return redirect()->back()->with('fail', 'Tidak memiliki hak untuk hapus pelanggan');
        }
        else
        {
            $this->customerRepository->destroy($customer);

            return redirect()->back()->with('success', 'Berhasil hapus pelanggan');
        }
    }

    public function exportCSV()
    {
        return $this->customerRepository->exportCSV();
    }

    public function exportExcel()
    {
        return $this->customerRepository->exportExcel();
    }

    public function exportPDF()
    {
        return $this->customerRepository->exportPDF();
    }
}
