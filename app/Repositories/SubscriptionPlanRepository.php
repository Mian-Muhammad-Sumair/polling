<?php


namespace App\Repositories;


use App\CRUD\Repositories\BaseCRUDRepository;;
use App\Models\SubscriptionPlan;

class SubscriptionPlanRepository extends BaseCRUDRepository implements SubscriptionPlanRepositoryInterface
{
   public function setup()
   {
       $this->setModel(SubscriptionPlan::class);

   }

//   public function create(array $data)
//   {
//      $item=parent::create($data);
//     return true;
//   }
//
//   public function update($id, array $data)
//   {
//     $item= parent::update($id,$data);
//       return true;
//   }
//    public function delete($id)
//    {
//        return true;
//    }
}
