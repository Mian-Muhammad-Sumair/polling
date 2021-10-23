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

    public function latestPaymentData(){
        $expiry_date='';
        $payment=Payment::where('user_id',auth()->id())->where('status',1)->with('subscriptionPlanValue')->latest()->first();
        if($payment){
            $expiry_date=$this->expiryDate($payment->approved_date,$payment->subscriptionPlanValue->plan_type,$payment->subscriptionPlanValue->plan_value);
        }

        return ['payment'=>$payment,'expiry'=>$expiry_date];
    }
    public function checkPlanValidity(){
        $payment=$this->latestPaymentData();
        $expiry_date=$payment['expiry'];
        $data=$expiry_date>now()?true:false;
        return $data;
    }
    public function checkActivePlanData(){
        $payment=$this->latestPaymentData();
        $expiry_date=$payment['expiry'];
        $data=$expiry_date>now()?$payment['payment']:false;
        return $data;
    }
    public function checkPlanValidPoll(){
        $pollLimit=0;
        $planDetails=$this->checkActivePlanData();
        if($planDetails){
        $pollLimit=$planDetails->subscriptionPlanValue->allow_poll;
        $poll=Poll::whereDate('created_at','>',$planDetails->approved_date)->count();
        }else{
            $poll=0;
        }
        $data=$pollLimit>$poll?true:false;
        return $data;
    }

    public function expiryDate($date,$type,$value){
       return Carbon::parse($date)->{"add" . ucfirst($type) . "s"}($value);
    }

}
