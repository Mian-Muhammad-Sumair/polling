<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'first_name',
        'last_name',
        'email',
        'country',
        'city',
        'state',
        'amount',
        'payment_mode',
        'approved_date',
        'status',
        'subscription_plan_value_id',
        'user_id',
    ];

    public function subscriptionPlanValue()
    {
        return $this->belongsTo(SubscriptionPlanValue::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
