<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin,customer,user');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $rules = array(
            'email' => 'required',
        );
        $poll=DB::table('polls')->whereDate('start_date','<=', now()->format('Y-m-d'))->whereDate('end_date','<=', now()->addMonths(1)->format('Y-m-d'))
            ->where('visibility','public')
//->addSelect(["number"=>DB::table('question_options')->whereColumn('polls.id','=','question_options.poll_id')->select('id')->first()])
//            ->addSelect(['poll_vote'=>DB::table('question_options')->whereColumn('polls.id','=','question_options.poll_id')->select('id')->get()])
            ->get();
        return view('home')->with(['poll'=>$poll]);
    }
}
