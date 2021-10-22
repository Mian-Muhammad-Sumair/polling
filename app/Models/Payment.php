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
        'name_on_card',
        'card_expiry',
        'approved_date',
        'status',
        'security_code',
        'card_number',
        'subscription_plan_value_id',
        'user_id',
    ];

    public function subscriptionPlanValue()
    {
        return $this->belongsTo(SubscriptionPlanValue::class);
    }

}
