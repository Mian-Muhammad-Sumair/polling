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
    ];
    public function identifierQuestion()
    {
        return $this->belongsTo(PollIdentifierQuestion::class);
    }





}
