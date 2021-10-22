<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use App\Models\SubscriptionPlanValue;
use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher as Hash;
use Illuminate\Database\Seeder;

class SubscriptionPlansSeeder extends Seeder
{

    /**
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
    private $model;
    private $subValue;


    public function __construct()
    {
        $this->model = resolve(SubscriptionPlan::class);
        $this->subValue = resolve(SubscriptionPlanValue::class);
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = [
            'name' => 'Plan 1',
            'info' => 'Make feedback automated and actionable by connecting to key business systems using APIs and powerful integrations, including Salesforce, Marketo, Tableau, and more.',
            'status' => 1
            ];
        $planValue = [
            'plan_type' => 'Month',
            'plan_value' => 1,
            'allow_poll' => 2,
            'amount' => 100,
            ];

        $item=$this->model->create($plan);
        $planValue['subscription_plan_id']=$item->id;
        $this->subValue->create($planValue);


    }
}
