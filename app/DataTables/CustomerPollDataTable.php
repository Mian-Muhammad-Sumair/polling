<?php

namespace App\DataTables;

use App\Models\Poll;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CustomerPollDataTable extends DataTable
{
    protected $index;
    protected $poll_data;
    protected $user_type;
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('#', function($item){
                $this->poll_data=$item;
                $this->index=$this->index+1;
                return $this->index;
            })
            ->addColumn('status', function($item){
                $type='badge-success';
                if($item->status!='Published' && $item->end_date>=now()){
                    $type='badge-error';
                }
                $status="<a href='poll/action/{$item->id}' ><span class='text-capitalize col-status badge ".$type."'>{$item->status}</span></a>";
                if($this->user_type=='admin'){
                    if($item->status=='Stopped'){
                        $status="<span class='text-capitalize col-status badge ".$type."'>Stopped</span>";
                    }else{
                        $status="<a href='poll/action/{$item->id}' ><span class='text-capitalize col-status badge ".$type."'>{$item->status}</span></a>";
                    }
                }
                if($item->end_date<=now()){
                    $status="<span class='text-capitalize col-status badge ".$type."'>Expired</span>";
                }
                return  $status;
            })->rawColumns(['action','status'])
            ->addColumn('action', function($item){
            $edit='';
            $delete='';
            if($this->user_type!='admin'){
                if($item->end_date>now() && $item->start_data>now()){
                    $edit="<a href='poll/{$item->id}/edit' class='col-edit'><i class='fa fa-edit'></i></a>";
                }
                $delete="<a href='poll/delete/{$item->id}' class='col-edit'><i class='fa fa-trash'></i></a>";
            }
            return
                "<a href='poll/view/{$item->id}' class='col-view'><i class='fa fa-eye' ></i></a>
                     {$edit}
                     {$delete}
                 ";
        })
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Poll $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Poll $model)
    {
        $this->user_type=auth()->user()->user_type;
        return $model->CustomerPoll()->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('customer-poll-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('#'),
            Column::make('name'),
            Column::make('start_date'),
            Column::make('end_date'),
            Column::make('question'),
            Column::make('category'),
            Column::make('visibility'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Poll_' . date('YmdHis');
    }
}
