<?php

namespace App\Http\Controllers;

use App\DataTables\SubscriptionPlanDataTable;
use App\Http\Requests\SubscriptionPlanStoreRequest;
use App\Http\Requests\SubscriptionPlanUpdateRequest;
use App\Models\SubscriptionPlan;
use App\Repositories\SubscriptionPlanRepositoryInterface;

class SubscriptionPlanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $repository;

    public function __construct(SubscriptionPlanRepositoryInterface $repository)
    {
        $this->repository=$repository;
        $this->middleware('auth:user,admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(SubscriptionPlanDataTable $dataTable)
    {
//        if(auth()->user()->hasAnyPermission(['View Subscription Plan'])){
         return $dataTable->render('subscriptionPlan.index_table',['title'=>'Subscription Plans List']);
//        }
     return abort(403);
    }
    public function create()
    {
        return view('subscriptionPlan.create');
    }

    public function store(SubscriptionPlanStoreRequest $request)
    {
        $data=$request->validated();
        $data= $this->repository->create($data)?
            toastr()->success('Successfully! Plan has been Created.'):
            toastr()->error('Sorry! Please try again later.');
        return redirect('/admin/subscription_plan');

    }

    public function show($id){
        $plan=SubscriptionPlan::where('id',$id)->first();
        return view('subscriptionPlan.edit')->with('plan',$plan);
    }

    public function update(SubscriptionPlanUpdateRequest $request,$id){
        $data=$request->validated();
        $data= $this->repository->update($id,$data)?
            toastr()->success('Successfully! Plan has been updated.'):
            toastr()->error('Sorry! Please try again later.');

        return redirect('/admin/subscription_plan');
    }
    public function delete($id){
        $data= $this->repository->delete($id)?
            toastr()->success('Successfully! Plan has been deleted.'):
            toastr()->error('Sorry! Please try again later.');
        return redirect('/admin/subscription_plan');
    }
    public function updateStatus($id){
        $subscriptionPlan=SubscriptionPlan::findOrFail($id);
        $subscriptionPlan->status=$subscriptionPlan->status==1?0:1;
        $subscriptionPlan->save()?
            toastr()->success('Successfully! Password is Updated.'):
            toastr()->error('Sorry! Please try again later.');
        return redirect('/admin/subscription_plan');
    }

}
