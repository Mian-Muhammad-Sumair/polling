<?php

namespace App\Http\Controllers;

use App\Http\Requests\PollParticipateRequest;
use App\Http\Requests\PollStoreRequest;
use App\Http\Requests\PollUpdateRequest;
use App\Models\poll;
use App\Models\QuestionOptions;
use App\Repositories\PollRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Session\Session;


class PollController extends Controller
{
    private $repository;

    public function __construct(PollRepositoryInterface $repository)
    {
        $this->middleware('auth:admin,customer');
        $this->repository=$repository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $polls = Poll::all();
        return view('poll.pollList', compact('polls'));

    }

    public function create(){
        return view('poll.create');
    }
    public function store(PollStoreRequest $request)
    {
        $data=$request->validated();
        $data['user_id']=auth()->id();
        $data= $this->repository->create($data);
        return redirect('dashboard')->with('status', 'Poll created!');
    }

    public function edit($id){
        return view('poll.edit');
    }

    public function update(PollUpdateRequest $request,$id){
        $data=$request->validated();
        $data= $this->repository->update($data,$id);
        return redirect('dashboard')->with('status', 'Poll updated!');
    }



}
