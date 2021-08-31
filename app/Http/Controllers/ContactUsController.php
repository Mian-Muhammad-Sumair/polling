<?php

namespace App\Http\Controllers;

use App\DataTables\ContactUsDataTable;
use App\DataTables\CustomerPollDataTable;
use App\Http\Requests\ContactUsStoreRequest;
use App\Repositories\ContactUsRepositoryInterface;


class ContactUsController extends Controller
{
    private $repository;

    public function __construct(ContactUsRepositoryInterface $repository)
    {
        $this->repository=$repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ContactUsDataTable $dataTable)
    {
        return $dataTable->render('admin.index_table',['title'=>'Contact Us List']);
    }

    public function store(ContactUsStoreRequest $request)
    {
        $data=$request->validated();
        $this->repository->create($data)?
            toastr()->success('Successfully! your form has been submitted.'):
            toastr()->error('Sorry! Please try again later.');
        return redirect('/home');

    }
    public function destroy($id){
        $this->repository->delete($id)?
            toastr()->success('Successfully! Entry  has been deleted.'):
            toastr()->error('Sorry! Please try again later.');
        return redirect('/admin/contact_us');
    }



}
