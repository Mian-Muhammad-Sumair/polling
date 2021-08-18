<?php

namespace App\Http\Controllers;

use App\DataTables\CustomerPollDataTable;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CustomerPollDataTable $dataTable)
    {
        return $dataTable->render('admin.index_table',['title'=>'Poll List']);
    }

    public function create(){
        return view('poll.create');
    }
    public function store(PollStoreRequest $request)
    {
        $data=$request->validated();
        $data['user_id']=auth()->id();
        $data= $this->repository->create($data)?
            toastr()->success('Successfully! Poll has been Created.'):
            toastr()->error('Sorry! Please try again later.');
        return back();

    }

    public function edit($id){
        $poll=Poll::where('user_id',auth()->id())->where('id',$id)->with(['questionsOptions','pollKeys','pollIdentifierQuestions'])->first();
        return view('poll.edit')->with('poll',$poll);
    }

    public function update(PollUpdateRequest $request,$id){
        $data=$request->validated();
        $data= $this->repository->update($id,$data)?
            toastr()->success('Successfully! Poll has been updated.'):
            toastr()->error('Sorry! Please try again later.');

        return redirect('dashboard');
    }
    public function delete($id){
        $data= $this->repository->delete($id)?
            toastr()->success('Successfully! Poll has been deleted.'):
            toastr()->error('Sorry! Please try again later.');
        return redirect('poll');
    }



}
