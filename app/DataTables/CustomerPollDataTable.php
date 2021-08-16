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
            ->addColumn('action', function($item){
                $action='';
                if($item->visibility=='public'){
                    $action="<a class='dropdown-item' href='poll/deactive/{$item->id}'>De Active</a>";
                }else{
                    $action=" <a class='dropdown-item' href='poll/active/{$item->id}'> Active</a>";
                }

           return     "<div class='button-header'>
                     <div class='dropdown'>
                        <button class='btn  dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                          Action
                        </button>
                        <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                        {$action}
                            <a class='dropdown-item' href='poll/view/{$item->id}'><i class='fa fa-eye'></i>  View</a>
                            <a class='dropdown-item' href='poll/{$item->id}/edit'><i class='fa fa-edit'></i> Edit</a>
                        </div>
                    </div>
                    </div>
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
            Column::make('id'),
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
