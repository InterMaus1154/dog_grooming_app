<?php

namespace App\Data;

class CreateCustomerData
{
    public function __construct(public string $name, public ?string $phoneNumber = null)
    {
    }
}
