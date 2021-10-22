<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlanValue extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subscription_plan_id',
        'plan_type',
        'plan_value',
        'allow_poll',
        'amount',
    ];
    public function subscriptionPlan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }


}
