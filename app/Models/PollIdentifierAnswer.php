<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;

class PollIdentifierAnswer extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identifier_question_id',
        'answer',
        'user_id',
    ];
    public function identifierQuestion()
    {
        return $this->belongsTo(PollIdentifierQuestion::class);
    }
    public function identifierVote()
    {
        return $this->belongsTo(PollVote::class,'user_id','user_id');
    }
    public function scopeIdentifyUser($query,$poll_id)
    {
        return  $query->addSelect(['poll_question'=>PollIdentifierQuestion::whereColumn('poll_identifier_questions.id','poll_identifier_answers.identifier_question_id')->where('poll_identifier_questions.poll_id',$poll_id)->select('identifier_question')]);
    }





}
