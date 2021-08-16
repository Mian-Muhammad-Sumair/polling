<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CustomerDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public $model;

    public function __construct(User $model)
    {
        $this->middleware('auth:admin');
        $this->model=$model->customer();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CustomerDataTable $dataTable)
    {
        return $dataTable->render('admin.index_table');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
       $this->model->findOrFail($id)->delete();
        toastr()->success('Successfully! Customer has been deleted.');
        return back();
    }
    public function status($id){
        $item=$this->model->findOrFail($id);
        if($item->status=='active'){
            $item->status='inactive';
        }else{
            $item->status='active';
        }
        $item->save()?
        toastr()->success('Successfully! Customer status has been updated.'):
        toastr()->error('Sorry! Please try again later.');
        return back();
    }
}
