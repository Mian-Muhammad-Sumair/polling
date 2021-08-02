<?php

namespace App\Http\Controllers;

use App\Http\Requests\PollStoreRequest;
use App\Models\poll;
use App\Models\QuestionOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PollController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('registerPoll');
    }
    public function store(Request $request)
    {

//     i als0 create store request seprate file but validation not working the issue is when valdition is true it will show no response
//     PollStoreRequest
//        $request->validate([
//            'name' => 'required',
//            'start_date' => 'required|date|after_or_equal:today',
//            'end_date' => 'required|date|after:start_date',
//            'info' => 'required',
//            'category' => 'required',
//            'visibility' => 'required',
//            'question' => 'required',
//            'option' => 'required|array',
//            'Poll_category' => 'required',
//            'key' => 'required|unique:polls,key',
//        ]);

        $startDate = $request['start_date'];
        $endDate = $request['end_date'];


        $poll= Poll::create([
            'name' => $request['name'],
            'start_date'  => $startDate,
            'end_date'  => $endDate,
            'info'  => $request['info'],
            'question'  => $request['question'],
            'category'  => $request['category'],
            'visible'  => $request['visibility'],
            'status'  => 1,
            'user_id'  => 1,
            'poll_category '  => $request['poll_category'],
            'key'  => $request['key'],
        ])->id;

        foreach ($request['option'] as $key => $value) {
             QuestionOptions::create([
                'poll_id' =>$poll,
                'question_option' =>$value
            ]);
        }
        return redirect('dashboard')->with('status', 'Poll updated!');
    }
}
