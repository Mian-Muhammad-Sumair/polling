<?php


namespace App\Repositories;


use App\CRUD\Repositories\BaseCRUDRepository;
use App\Models\Subscribe;


class SubscribeRepository extends BaseCRUDRepository implements SubscribeRepositoryInterface
{
   public function setup()
   {
       $this->setModel(Subscribe::class);
   }

}
