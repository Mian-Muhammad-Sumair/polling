<?php


namespace App\Repositories;


use App\CRUD\Repositories\BaseCRUDRepository;
use App\Models\ContactUs;


class ContactUsRepository extends BaseCRUDRepository implements ContactUsRepositoryInterface
{
   public function setup()
   {
       $this->setModel(ContactUs::class);
   }

}
