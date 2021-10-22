<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'info',
        'status',
    ];
    public function subscriptionPlanValues()
    {
        return $this->hasMany(SubscriptionPlanValue::class);
    }
    public function latestSubscriptionPlanValue()
    {
        return $this->hasOne(SubscriptionPlanValue::class)->latest();
    }


}
