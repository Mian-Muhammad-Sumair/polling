<?php

namespace App\Repositories;


use App\CRUD\Repositories\BaseCRUDRepository;;

use App\Models\Payment;

class PaymentRepository extends BaseCRUDRepository implements PaymentRepositoryInterface
{
   public function setup()
   {
       $this->setModel(Payment::class);

   }
}

