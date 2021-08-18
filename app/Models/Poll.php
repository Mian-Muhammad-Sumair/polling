<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;

class Poll extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'info',
        'question',
        'category',
        'visibility',
        'option_type',
        'status',
        'user_id',
    ];

    protected $casts=[
        'option_type'=>'array'
    ];

    public function questionsOptions()
    {
        return $this->hasMany(QuestionOptions::class);
    }
    public function pollKeys()
    {
        return $this->hasMany(PollKey::class);
    }

    public function pollIdentifierQuestions()
    {
        return $this->hasMany(PollIdentifierQuestion::class);
    }
    public function scopeCustomerPoll($query){
        if(session('auth.current')!='admin') {
            $query->where('user_id', auth()->id());
            }
        return $query;

    }
    public function scopeExpiredPoll($query){
        return $query->whereDate('end_date','<',now());
    }
    public function scopeActivePoll($query){
        return $query->whereDate('end_date','>',now());
    }
    public function scopePollVotes($query,$id){

        $options=QuestionOptions::where('poll_id',$id)->with('OptionVote')->get();

        $votes=[];

      foreach($options as $index=>$option){
          $total_vote=00;
          if(isset($option->OptionVote)&&$option->OptionVote->count()!=0){
              $total_vote=$option->OptionVote->count();
          }
          $array=[
              'question_option'=>$option->question_option,
              'poll_id' =>$option->poll_id,
              'total_Vote'=>$total_vote,
          ];
          array_push($votes, $array);
      }
        return $votes;


    }




}
