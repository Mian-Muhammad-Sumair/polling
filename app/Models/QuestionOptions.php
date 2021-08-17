<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOptions extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'poll_id',
        'question_option'
    ];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }
    public function scopePollOptions($query, $id){
        $query->where('poll_id', $id);
        return $query;
    }
    public function OptionVote()
    {
        return $this->hasmany(PollVote::class,'answer','id');
    }
    public function scopeTotalVote($query, $id)
    {
        $total_vote=PollVote::where('answer',$id)->count();
        return $total_vote;
    }

}
