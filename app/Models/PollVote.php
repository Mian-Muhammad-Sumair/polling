<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;

class PollVote extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'answer',
        'user_id',
    ];


    public function identifierAnswer()
    {
        return $this->hasMany(PollIdentifierAnswer::class,'user_id','user_id');
    }
    public function scopeOptionsVotes($query,$id){
        return $query->where('answer',$id);
    }



}
