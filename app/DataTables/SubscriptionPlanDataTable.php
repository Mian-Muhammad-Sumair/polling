<?php

namespace App\DataTables;

use App\Models\Customer;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SubscriptionPlanDataTable extends DataTable
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
//                <a href='subscription_plan/delete/{$item->id}' class='col-delete'><i class='fa fa-trash'></i></a>
           return     "
                <a href='/admin/subscription_plan/{$item->id}' class='col-edit'><i class='fa fa-edit'></i></a>
                ";
            })
            ->addColumn('#', function($item){
                $this->index=$this->index+1;
                return $this->index;
            })
            ->addColumn('plan_type', function($item){
                return $item->latestSubscriptionPlanValue->plan_type;
            })
            ->addColumn('plan_value', function($item){
                return $item->latestSubscriptionPlanValue->plan_value;
            })
            ->addColumn('allow_poll', function($item){
                return $item->latestSubscriptionPlanValue->allow_poll;
            })   ->addColumn('amount', function($item){
                return $item->latestSubscriptionPlanValue->amount;
            })
            ->addColumn('status', function($item){
                $type='badge-error';
                $status="Disabled";
                if($item->status){
                    $status="Active";
                    $type='badge-success';
                }
           return     "
                <a href='subscription_plan/status/{$item->id}' class='text-capitalize col-status'><span class='badge ".$type."'>{$status}</span></a>
                ";
            })->rawColumns(['action','status'])
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SubscriptionPlan $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('subscription-plan-data-table')
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
            Column::make('info'),
            Column::make('plan_type'),
            Column::make('plan_value'),
            Column::make('allow_poll'),
            Column::make('amount'),
            Column::computed('status')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
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
        return 'Customer_' . date('YmdHis');
    }
}
