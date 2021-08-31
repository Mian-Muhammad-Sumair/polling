<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth:admin,customer,user');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $rules = array(
            'email' => 'required',
        );
        $polls=Poll::whereDate('start_date','<=', now()->format('Y-m-d'))->whereDate('end_date','<=', now()->addMonths(1)->format('Y-m-d'))
            ->where('visibility','public')->get();

        foreach($polls as $index=>$poll){
            $pollVotes=Poll::PollVotes($poll->id);
            $polls[$index]['votes']=$pollVotes;
        }
        return view('home')->with(['polls'=>$polls]);
    }

    public function subscriptionPlan()
    {
        $subscriptionPlans=SubscriptionPlan::where('status',1)->get();
        return view('selectPlan')->with(['subscriptionPlans'=>$subscriptionPlans]);
    }
}
