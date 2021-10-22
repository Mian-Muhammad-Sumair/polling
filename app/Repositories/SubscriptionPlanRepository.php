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
    /**
     * @param array $data
     * @return User|\Gmz\Common\Traits\Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {

        $item = $this->getModel()->create($data);
        $item->latestSubscriptionPlanValue()->create($data);
        return $item;
    }

    public function update($id, array $data)
    {
//        $item = $this->getModel()->findOrFail($id);
        $item=$this->getModel()->where('id',$id)->with('latestSubscriptionPlanValue')->first();
        if( $item->latestSubscriptionPlanValue->allow_poll!=$data['allow_poll'] ||
            $item->latestSubscriptionPlanValue->plan_value!=$data['plan_value'] ||
            $item->latestSubscriptionPlanValue->amount!=$data['amount'] ||
            $item->latestSubscriptionPlanValue->plan_type!= $data['plan_type']){
            $item->latestSubscriptionPlanValue()->create($data);
        }
        $item= parent::update($id,$data);
        return $item;
    }

}
