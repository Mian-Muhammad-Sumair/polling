<?php

namespace App\Http\Controllers;

use App\DataTables\PaymentsDataTable;
use App\DataTables\SubscriptionPlanDataTable;
use App\Http\Requests\PaymentStoreRequest;
use App\Http\Requests\SubscriptionPlanStoreRequest;
use App\Http\Requests\SubscriptionPlanUpdateRequest;
use App\Models\Payment;
use App\Models\SubscriptionPlan;
use App\Models\SubscriptionPlanValue;
use App\Repositories\PaymentRepositoryInterface;
use App\Repositories\SubscriptionPlanRepositoryInterface;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $repository;

    public function __construct(PaymentRepositoryInterface $repository)
    {
        $this->repository=$repository;
        $this->middleware('auth:user,admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(PaymentsDataTable $dataTable)
    {
        $userType=auth('admin')->check()?'admin':'customer';
        $userId=auth()->id();
        $dataTable->with('userType', $userType);
        $dataTable->with('userId', $userId);
        $dataTable->with('activePlan', $this->checkActivePlanData());
         return $dataTable->render('payment.index_table',['title'=>'Payments List']);;
    }

    public function store(PaymentStoreRequest $request)
    {
        if(  $this->checkPlanValidity()){
            toastr()->error('Sorry! Your plan is already Active.');
            return redirect('/dashboard');
        }
        $data=$request->validated();
        $data['user_id']=auth()->id();
        $plan=SubscriptionPlan::where('id',$data['plan'])->with('latestSubscriptionPlanValue')->first();
        $data['subscription_plan_value_id']=$plan->latestSubscriptionPlanValue->id;
        $data['amount']=$plan->latestSubscriptionPlanValue->amount;
        $data['approved_date']=now();
        $data['expiry_date']=now()->addYear();

        $data= $this->repository->create($data)?
            toastr()->success('Successfully! Payments Requested has been Created.'):
            toastr()->error('Sorry! Please try again later.');
        return redirect('/admin/subscription_plan');

    }

    public function show($id){
         if( $this->checkPlanValidity()){
             toastr()->error('Sorry! Your plan is already Active.');
             return redirect('/dashboard');
         }
        view('payment.create')->with('plan',$id);

    }


    public function updateStatus($id){

    }

}
