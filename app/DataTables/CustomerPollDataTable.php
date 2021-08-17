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
                $this->index=$this->index+1;
                return $this->index;
            })
            ->addColumn('action', function($item){
                $action='';
                if($item->visibility=='public'){
                    $action="<a  href='poll/deactive/{$item->id}' class='col-delete'><i class='fa fa-ban'></i></a>";
                }else{
                    $action="<a  href='poll/active/{$item->id}' class='col-delete'><i class='fa fa-check'></i></a>";
                }

           return     "
                    {$action}
                <a  href='poll/view/{$item->id}' class='col-view'><i class='fa fa-eye' ></i></a>
                <a href='poll/{$item->id}/edit' class='col-edit'><i class='fa fa-edit'></i></a>

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
