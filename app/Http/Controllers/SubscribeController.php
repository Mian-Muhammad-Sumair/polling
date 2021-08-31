<?php

namespace App\Http\Controllers;

use App\DataTables\SubscribeDataTable;
use App\Http\Requests\SubscribeStoreRequest;
use App\Repositories\SubscribeRepositoryInterface;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    private $repository;

    public function __construct(SubscribeRepositoryInterface $repository)
    {
        $this->repository=$repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SubscribeDataTable $dataTable)
    {
        return $dataTable->render('admin.index_table',['title'=>'subscription List']);
    }

    public function store(SubscribeStoreRequest $request)
    {
        $data=$request->validated();
        $this->repository->create($data)?
            toastr()->success('Successfully! You have subscribed.'):
            toastr()->error('Sorry! Please try again later.');
        return redirect('/home');

    }
    public function destroy($id){
        $this->repository->delete($id)?
            toastr()->success('Successfully!Subscription  has been deleted.'):
            toastr()->error('Sorry! Please try again later.');
        return redirect('/admin/subscribe');
    }
}
