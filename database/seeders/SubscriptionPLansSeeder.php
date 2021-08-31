<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Seeder;

class SubscriptionPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubscriptionPlan::create([
            'name' => 'Plan 1',
            'info' => 'Make feedback automated and actionable by connecting to key business systems using APIs and powerful integrations, including Salesforce, Marketo, Tableau, and more.',
            'plan_type' => 'Month',
            'keys' => 5,
            'total_poll' => 2,
            'status' => 1
        ]);
        SubscriptionPlan::create([
            'name' => 'Plan 2',
            'info' => 'Make feedback automated and actionable by connecting to key business systems using APIs and powerful integrations, including Salesforce, Marketo, Tableau, and more.',
            'plan_type' => 'Month',
            'keys' => 5,
            'total_poll' => 5,
            'status' => 1
        ]);
        SubscriptionPlan::create([
            'name' => 'Plan 3',
            'info' => 'Make feedback automated and actionable by connecting to key business systems using APIs and powerful integrations, including Salesforce, Marketo, Tableau, and more.',
            'plan_type' => 'Month',
            'keys' => 5,
            'total_poll' => 10,
            'status' => 1
        ]);
    }
}
