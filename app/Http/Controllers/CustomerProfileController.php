<?php

namespace App\Http\Controllers;

use App\DataTables\CustomerPollDataTable;
use App\DataTables\CustomerPollOptionDataTable;
use App\DataTables\CustomerPollOptionTable;
use App\DataTables\PollOptionVotesDataTable;
use App\Http\Requests\PollParticipateRequest;
use App\Http\Requests\PollStoreRequest;
use App\Http\Requests\PollUpdateRequest;
use App\Models\poll;
use App\Models\PollVote;
use App\Models\QuestionOptions;
use App\Models\User;
use App\Repositories\PollRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
    public function index()
    {
        $user=User::where('id',auth()->id())->first();
        $poll=Poll::where('user_id',auth()->id());
        $totalPoll=$poll->count();
        $activePoll=$poll->Activepoll()->count();
        $expiredPoll=Poll::where('user_id',auth()->id())->ExpiredPoll()->count();
        return view('dashboard')->with(['user'=> $user,'totalPoll'=>$totalPoll,'activePoll'=>$activePoll,'expiredPoll'=>$expiredPoll]);
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

    public function update(PollUpdateRequest $request,$id){

    }
    public function pollStatus($id){
        $messege='';
        $poll=Poll::where('id',$id);
        // check if the user is admin or customer
        $poll= auth()->user()->user_type=='admin'? $poll:
            $poll->where('user_id',auth()->id());

        $poll=$poll->first();
        // update poll visibility if private if public or private if public
        $poll->visibility = $poll->visibility=='public'? 'private':
                                'public';
        // Change response message
        $messege = $poll->visibility=='public'?'Successfully! Poll is activated.':
            'Successfully! Poll is  de activated.';
        $poll->save()?
            toastr()->success($messege):
            toastr()->error('Sorry! Please try again later.');
        return redirect('/poll');
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




}
