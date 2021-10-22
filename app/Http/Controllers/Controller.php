<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Poll;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function checkPlanValidity(){
        $expiry_date='';
        $plan=Payment::where('user_id',auth()->id())->where('status',1)->with('subscriptionPlanValue')->latest()->first();
        if($plan){
            $expiry_date=$this->expiryDate($plan->approved_date,$plan->subscriptionPlanValue->plan_type,$plan->subscriptionPlanValue->plan_value);
        }
        $data=$expiry_date>now()?true:false;
        return $data;
    }
    public function checkActivePlanData(){
        $plan=Payment::where('user_id',auth()->id())->where('status',1)->with('subscriptionPlanValue.subscriptionPlan')->latest()->first();

        if($plan){
            $expiry_date=$this->expiryDate($plan->approved_date,$plan->subscriptionPlanValue->plan_type,$plan->subscriptionPlanValue->plan_value);
//            $expiry_date= Carbon::parse($plan->approved_date)->{"add" . ucfirst($plan->subscriptionPlanValue->plan_type) . "s"}($plan->subscriptionPlanValue->plan_value);
        }
        $data=$expiry_date>now()?$plan:false;
        return $data;
    }
    public function checkPlanValidPoll(){
        $pollLimit=0;
        $planDetails=$this->checkActivePlanData();
        if($planDetails){
        $pollLimit=$planDetails->subscriptionPlanValue->allow_poll;
        $poll=Poll::whereDate('created_at','>',$planDetails->approved_date)->count();
        }
        $data=$pollLimit>$poll?true:false;
        return $data;
    }

    public function expiryDate($date,$type,$value){
       return Carbon::parse($date)->{"add" . ucfirst($type) . "s"}($value);
    }

}
