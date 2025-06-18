<?php

namespace App\Services;

use App\Models\Customer;

class UserService
{
    public function getCustomerById($id)
    {
        return Customer::find($id);
    }
}