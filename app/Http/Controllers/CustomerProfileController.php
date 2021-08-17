<?php

namespace App\Http\Controllers;

use App\DataTables\CustomerPollDataTable;
use App\DataTables\CustomerPollOptionDataTable;
use App\DataTables\CustomerPollOptionTable;
use App\Http\Requests\PollParticipateRequest;
use App\Http\Requests\PollStoreRequest;
use App\Http\Requests\PollUpdateRequest;
use App\Models\poll;
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
        $this->middleware('auth:customer');
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
    public function activePoll($id){
        $poll=Poll::where('user_id',auth()->id())->where('id',$id)->first();
        $poll->visibility='public';
        $poll->save();
        toastr()->success('Successfully! Poll is activated.');
        return redirect('/poll');
    }
    public function deactivePoll($id){
        $poll=Poll::where('user_id',auth()->id())->where('id',$id)->first();
        $poll->visibility='private';
        $poll->save();
        toastr()->success('Successfully! Poll is  de activated.');
        return redirect('/poll');
    }
    public function pollView($id,CustomerPollOptionDataTable $dataTable){
        $poll=Poll::where('user_id',auth()->id())->where('id',$id)->with(['pollKeys','pollIdentifierQuestions','questionOptions'])->first();
        $pollVote=Poll::PollVotes($id);
        $dataTable->with('id', $id);
        return $dataTable->render('poll.pollView',['poll'=>$poll,'TotalVote'=>$pollVote]);
    }




}
