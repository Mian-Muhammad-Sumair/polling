<?php

namespace App\DataTables;

use App\Models\Poll;
use App\Models\QuestionOptions;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CustomerPollOptionDataTable extends DataTable
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
            ->addColumn('total_vote', function($item){
                $totalVote=QuestionOptions::TotalVote($item->id);
                return     $totalVote;
            })
            ->addColumn('#', function($item){
                $this->index=$this->index+1;
               return $this->index;
            })

            ->addColumn('action', function($item){
                return     "  <a class='col-view' href='poll/view/{$item->id}'><i class='fa fa-eye'> </i>  View</a>";
            })
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\QuestionOptions $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(QuestionOptions $model)
    {
        return $model->PollOptions($this->id)->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('customer-poll-option-table')
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
            Column::make('question_option'),
            Column::computed('total_vote'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
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
