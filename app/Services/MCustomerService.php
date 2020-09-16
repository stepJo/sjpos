<?php

namespace App\Services;

use App\Models\MCustomer\Customer;

class MCustomerService {
    public function allCustomers()
    {
       return Customer::get(['c_id', 'c_name']);
    }
}