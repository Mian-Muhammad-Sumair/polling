<?php

namespace App\Http\Controllers;

use App\Http\Requests\PollStoreRequest;
use App\Http\Requests\PollUpdateRequest;
use App\Models\poll;
use App\Models\QuestionOptions;
use App\Repositories\PollRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
        return 'Table will Goes here.';
    }

    public function create(){
        return view('poll.create');
    }
    public function store(PollStoreRequest $request)
    {
        $data=$request->validated();
        $data['user_id']=auth()->id();
        $data= $this->repository->create($data);
        return redirect('dashboard')->with('status', 'Poll updated!');
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
