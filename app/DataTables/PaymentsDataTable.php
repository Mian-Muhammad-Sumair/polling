<?php

namespace App\DataTables;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PaymentsDataTable extends DataTable
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
            ->addColumn('action', function($item){
//            <a href='/plan/cancel/{$item->id}' class='text-capitalize col-status'><span class='badge badge-error'>Cancel Plan</span></a>
                $acton='';
                if($this->activePlan && $this->activePlan->id==$item->id && $this->userType!='admin'){
                    $acton="   <a href='/plan/cancel/{$item->id}' class='text-capitalize col-status'><span class='badge badge-error'>Cancel Plan</span></a>";
                }
           return    $acton;
            })
            ->addColumn('#', function($item){
                $this->index=$this->index+1;
                return $this->index;
            })
            ->addColumn('user', function($item){
                    return $item->user->name;
            })
            ->addColumn('plan', function($item){
                return $item->SubscriptionPlanValue->SubscriptionPlan->name;
            })
            ->addColumn('plan_type', function($item){
                return $item->SubscriptionPlanValue->plan_type;
            })
            ->addColumn('plan_value', function($item){
                return $item->SubscriptionPlanValue->plan_value;
            })
            ->addColumn('allow_poll', function($item){
                return $item->SubscriptionPlanValue->allow_poll;
            })
            ->addColumn('amount', function($item){
                return $item->SubscriptionPlanValue->amount;
            })
            ->addColumn('plan_expiry', function($item){
                $expiry='';
                if($item->approved_date){
                    $expiry= Carbon::parse($item->approved_date)->{"add" . ucfirst($item->SubscriptionPlanValue->plan_type) . "s"}($item->SubscriptionPlanValue->plan_value);
                    $expiry=$expiry->toDateString();
                }
                return $expiry;
            })
            ->addColumn('status', function($item){
                $type='badge-error';
                $status="Expired";
                if($item->status==1){
                    $status="Active";
                    $type='badge-success';
                }elseif($item->status==2){
                    $status="Canceled";
                }
           return     "
                <span class='text-capitalize col-status'><span class='badge ".$type."'>{$status}</span></span>
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
    public function query(Payment $model)
    {
        $data= $model->newQuery()->with('SubscriptionPlanValue.SubscriptionPlan');
        if($this->userType!='admin'){
            $data= $data->where('user_id',$this->userId);
        }
        return $data;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('payments-data-table')
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
        if($this->userType=='admin'){
            $user=Column::make('user');
        }
        return [
            Column::make('#'),
            $user,
            Column::make('first_name'),
            Column::make('last_name'),
            Column::make('payment_mode'),
            Column::make('approved_date'),
            Column::make('plan'),
            Column::make('plan_type'),
            Column::make('plan_value'),
            Column::make('allow_poll'),
            Column::make('plan_expiry'),
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
            Column::make('amount'),

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
