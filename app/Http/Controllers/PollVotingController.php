<?php

namespace App\Http\Controllers;


use App\Http\Requests\PollIdentifierQuestionStoreRequest;
use App\Http\Requests\PollParticipateRequest;
use App\Http\Requests\PollVotingRequest;
use App\Models\Poll;
use App\Models\PollIdentifierAnswer;
use App\Models\PollIdentifierQuestion;
use App\Models\PollKey;
use App\Models\PollVote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class PollVotingController extends Controller
{
    private $repository;

    public function __construct()
    {
//        $this->middleware('auth:user,user,customer');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

    }

    public function create(){

    }
    public function show($id,$poll){
        $pollData=Poll::where('id',$poll)->with('questionOptions')->first();
        $name=User::where('id',$pollData['user_id'])->select('name')->first();
        return view('createPoll')->with(['poll'=>$pollData,'creator_name' =>$name['name'],'id'=>$id]);
    }
    public function store(PollVotingRequest $request)
    {
        $data=$request->validated();
        $vote=PollVote::create($data);
        return redirect('dashboard')->with('status', 'Success');

    }

    public function edit($id){

    }

    public function update(Request $request,$id){

    }

    public function showParticipationForm()
    {
        return view('pollParticipation');
    }
    public function showPollIdentifyForm($id)
    {
        $pollId=PollKey::where('key',$id)->select('poll_id')->first();
        $pollData=Poll::where('id',$pollId['poll_id'])->with('pollIdentifierQuestions')->first();
        $name=User::where('id',$pollData['user_id'])->select('name')->first();
        return view('pollIdentify')->with(['poll'=>$pollData,'creator_name' =>$name['name'],'pollCode'=>$pollId['poll_id']]);
    }

    public function pollParticipate(PollParticipateRequest $request){
        $data=$request->validated();
        return redirect('vote/participate/'.$data['polling_key'])->with( ['key' => $data['polling_key']] );
    }

    public function storePollIdentifyForm(PollIdentifierQuestionStoreRequest $request)
    {

        $data=$request->validated();
        if(!auth('customer')->check() && !auth('admin')->check()  ){
            $userId=request()->ip();

        }else{
            $userId=auth('customer')->check()?auth('customer')->id():auth('admin')->id();
        }
        foreach($data['answer'] as $answer){
            if($answer['question']){
                $entry=[
                    'user_id'=>$userId,
                    'identifier_question_id'=>$answer['id'],
                    'answer'=>$answer['answer'],
                ];
                $vote=PollIdentifierAnswer::create($entry);
            }
        }
        return redirect('voting/'.$userId.'/'.$request['poll_code'])->with( ['id' => $request['poll_code']] );
    }

}
