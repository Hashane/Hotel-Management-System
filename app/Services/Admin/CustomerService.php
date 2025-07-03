<?php

namespace App\Services\Admin;

use App\Models\Customer;

class CustomerService
{
    public function store(array $data): void
    {
        Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);
    }
}
