<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poll;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){


        $chart_options = [
            'chart_title' => 'Customers Register by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'where_raw' =>"user_type='customer'" ,
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'bar',
        ];
        $customersBarChart = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Customers by Status',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\User',
            'where_raw' =>"user_type='customer'" ,
            'group_by_field' => 'status',
            'chart_type' => 'pie',
            'filter_field' => 'created_at',
            'filter_period' => 'year', // show users only registered this month
        ];

        $customerPieChart = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Polls by Status',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Poll',
            'conditions'            => [
                ['name' => 'Poll Publish', 'condition' => "status='Published'", 'color' => 'black', 'fill' => true],
                ['name' => 'Poll Completed', 'condition' => 'end_date <='.date("Y-m-d"), 'color' => 'blue', 'fill' => true],
            ],
            'group_by_field' => 'created_at',
            'chart_type' => 'line',
            'filter_field' => 'created_at',
            'filter_period' => 'year', // show users only registered this month
        ];

        $pollLineChart = new LaravelChart($chart_options);
        $chart_options = [
            'chart_title' => 'Customers by Status',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\User',
            'where_raw' =>"user_type='customer'" ,
            'group_by_field' => 'status',
            'chart_type' => 'pie',
            'filter_field' => 'created_at',
            'filter_period' => 'year', // show users only registered this month
        ];

        $customerPieChart = new LaravelChart($chart_options);
        $totalActiveCustomer = User::customer()->where('status','active')
            ->count();

        $totalPublishPolls  =Poll::where('status','Published')->count();
        $totalOpenedPolls=Poll::where('status','Published')->whereDate('start_date', '<=', date("Y-m-d"))
            ->whereDate('end_date', '>=', date("Y-m-d"))->count();
        return view('admin.dashboard',compact('totalPublishPolls','totalOpenedPolls','totalActiveCustomer','customersBarChart','customerPieChart','pollLineChart'));
    }

}
