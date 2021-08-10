<?php

namespace App\Http\Controllers;


use App\Http\Requests\PollParticipateRequest;
use App\Http\Requests\PollVotingRequest;
use App\Models\poll;

use App\Models\PollVote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class PollVotingController extends Controller
{
    private $repository;

    public function __construct()
    {
        $this->middleware('auth:admin,customer');

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
    public function show($id){
        $pollData=Poll::where('key',$id)->with('questionsOptions')->first();
        $name=User::where('id',$pollData['user_id'])->select('name')->first();

        return view('createPoll')->with(['poll'=>$pollData,'creator_name' =>$name['name']]);
    }
    public function store(PollVotingRequest $request)
    {
        $data=$request->validated();
        $data['user_id']=auth()->id();
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

    public function pollParticipate(PollParticipateRequest $request){
        $data=$request->validated();
        return redirect('voting/'.$data['polling_key'])->with( ['key' => $data['polling_key']] );
    }

}
