<?php

namespace App\Http\Controllers;

use App\DataTables\CustomerPollDataTable;
use App\DataTables\CustomerPollKeysDataTable;
use App\DataTables\CustomerPollOptionDataTable;
use App\DataTables\CustomerPollOptionTable;
use App\DataTables\PollOptionVotesDataTable;
use App\Http\Requests\PollParticipateRequest;
use App\Http\Requests\PollStoreRequest;
use App\Http\Requests\PollUpdateRequest;
use App\Http\Requests\UserPasswordChangeRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\poll;
use App\Models\PollVote;
use App\Models\QuestionOptions;
use App\Models\User;
use App\Repositories\PollRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Symfony\Component\HttpFoundation\Session\Session;


class CustomerProfileController extends Controller
{
    private $repository;

    public function __construct(PollRepositoryInterface $repository)
    {
        $this->middleware('auth:customer,admin');
        $this->repository=$repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CustomerPollDataTable $dataTable)
    {
        $chart_options = [
            'chart_title' => 'Poll created by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Poll',
            'where_raw' =>"user_id='".auth()->id()."'" ,
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'bar',
        ];
        $customersBarChart = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Polls by Status',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Poll',
            'where_raw' =>"user_id='".auth()->id()."'" ,
            'group_by_field' => 'status',
            'chart_type' => 'pie',
            'filter_field' => 'created_at',
            'filter_period' => 'year', // show users only registered this month
        ];

        $pollPieChart = new LaravelChart($chart_options);
        $chart_options = [
            'chart_title' => 'Customers by Status',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\User',
            'where_raw' =>"user_type='customer'" ,
            'group_by_field' => 'status',
            'chart_type' => 'pie',
            'filter_field' => 'created_at',
            'filter_period' => 'year', // show users only registered this month
        ];

        $customerPieChart = new LaravelChart($chart_options);




        $user=User::where('id',auth()->id())->first();
        $poll=Poll::where('user_id',auth()->id());
        $totalPoll=$poll->count();
        $activePoll=$poll->Activepoll()->count();
        $expiredPoll=Poll::where('user_id',auth()->id())->ExpiredPoll()->count();
        return  $dataTable->render('dashboard',['customersBarChart'=>$customersBarChart,'pollPieChart'=>$pollPieChart,'user'=>$user,'totalPoll'=>$totalPoll,'activePoll'=>$activePoll,'expiredPoll'=>$expiredPoll]);

    }

    public function create(){
        return view('poll.create');
    }
    public function store(PollStoreRequest $request)
    {

    }

    public function edit($id){
        return view('poll.edit');
    }

    public function update(UserUpdateRequest $request){

        $data=$request->validated();
        $user=User::where('id',auth()->id())->first();
        $user->name=$data['name'];
        $user->email=$data['email'];
        $user->about=$data['about'];
            $user->save()?
            toastr()->success('Successfully! Profile is Updated.'):
            toastr()->error('Sorry! Please try again later.');
        return redirect('dashboard');

    }
    public function pollStatus($id){
        $messege='';
        $poll=Poll::where('id',$id);

        // check if the user is admin or customer
        $poll= auth()->user()->user_type=='admin'? $poll:
            $poll->where('user_id',auth()->id());
        $poll=$poll->first();
        if(auth()->user()->user_type=='admin') {

            $poll->status = $poll->status=='Published'?'Banned':'Published';
            $poll->edit_by =$poll->status=='Published'?0: auth()->id();
        }else{

            $poll->status = $poll->status=='Published'?'Stopped':'Published';
        }

        // Change response message
        $message = $poll->status=='Published'?'Successfully! Poll is activated.':
            'Successfully! Poll is  Stopped.';

        $poll->save()?
            toastr()->success($message):
            toastr()->error('Sorry! Please try again later.');
        return redirect('/dashboard');
    }
    public function pollVisibility($id){
        $messege='';
        $poll=Poll::where('id',$id)->first();

            // update poll visibility if private if public or private if public
            $poll->visibility = $poll->visibility=='public'?'private':'public';


        $poll->save()?
            toastr()->success('Successfully! Poll type is changed.'):
            toastr()->error('Sorry! Please try again later.');
        return redirect('/dashboard');
    }
    public function pollView($id,CustomerPollOptionDataTable $datatable,CustomerPollKeysDataTable$pollKeysDataTable){
        $poll=Poll::where('id',$id)->with(['pollKeys','pollIdentifierQuestions','questionOptions']);
        if(!auth('admin')->check()){
            $poll=$poll->where('user_id',auth()->id());
        }

        $poll=$poll->first();
        $TotalVote=Poll::PollVotes($id);
        $datatable->with('id', $id);
        $pollKeysDataTable->with('id', $id);
        return $datatable->render('poll.pollView',['poll'=>$poll,'TotalVote'=>$TotalVote]);
//        return ($datatable)->render(
//            'poll.pollView',
//                compact('datatable', 'poll','TotalVote')
//        );

//        return view('poll.pollView', compact('poll', 'TotalVote', 'datatable'));

    }
    public function pollVotes($pollID,$id,PollOptionVotesDataTable $dataTable){
        $poll=Poll::where('id',$pollID)->with(['pollKeys','questionOptions','pollIdentifierQuestions']);
        if(!auth('admin')->check()){
            $poll=$poll->where('user_id',auth()->id());
        }
        $poll=$poll->first();
        $selectedOption=QuestionOptions::where('id',$id)->first();
        $pollVote=Poll::PollVotes($pollID);
        $dataTable->with('id', $id);
        $dataTable->with('selected', $selectedOption);
        $dataTable->with('pollIdentifierQuestions', $poll->pollIdentifierQuestions);
        return $dataTable->render('poll.pollVotes',['poll'=>$poll,'selectedOption'=>$selectedOption,'pollVote'=>$pollVote]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCustomer($id)
    {
        $user=User::where('id',auth()->id())->where('id',$id)->first();
        return view('auth.edit')->with('user',$user);

    }

    public function updatePassword(UserPasswordChangeRequest $request)
    {
        $data=$request->validated();
        $user=User::where('id',auth()->id())->first();
        $user->password=Hash::make($data['new_password']);
        $user->save()?
            toastr()->success('Successfully! Password is Updated.'):
            toastr()->error('Sorry! Please try again later.');
        return redirect('dashboard');

    }




}
