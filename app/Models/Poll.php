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
        'key',
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




}
