<?php

namespace App\Http\Controllers;

use App\DataTables\CustomerPollDataTable;
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
        $user=User::where('id',auth()->id())->first();
        $poll=Poll::where('user_id',auth()->id());
        $totalPoll=$poll->count();
        $activePoll=$poll->Activepoll()->count();
        $expiredPoll=Poll::where('user_id',auth()->id())->ExpiredPoll()->count();
        return $dataTable->render('dashboard',['user'=> $user,'totalPoll'=>$totalPoll,'activePoll'=>$activePoll,'expiredPoll'=>$expiredPoll]);

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
            // update poll visibility if private if public or private if public
            $poll->status = $poll->status=='Published'?'Banned':'Published';
            $poll->edit_by =$poll->status=='Published'?0: auth()->id();
        }else{
            // update poll visibility if private if public or private if public
            $poll->status = $poll->status=='Published'?'Stopped':'Published';
        }

        // Change response message
        $message = $poll->visibility=='public'?'Successfully! Poll is activated.':
            'Successfully! Poll is  Stopped.';

        $poll->save()?
            toastr()->success($message):
            toastr()->error('Sorry! Please try again later.');
        return redirect('/dashboard');
    }
    public function pollView($id,CustomerPollOptionDataTable $dataTable){
        $poll=Poll::where('user_id',auth()->id())->where('id',$id)->with(['pollKeys','pollIdentifierQuestions','questionOptions'])->first();
        $pollVote=Poll::PollVotes($id);
        $dataTable->with('id', $id);
        return $dataTable->render('poll.pollView',['poll'=>$poll,'TotalVote'=>$pollVote]);
    }
    public function pollVotes($pollID,$id,PollOptionVotesDataTable $dataTable){
        $poll=Poll::where('user_id',auth()->id())->where('id',$pollID)->with(['pollKeys','questionOptions','pollIdentifierQuestions'])->first();
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
