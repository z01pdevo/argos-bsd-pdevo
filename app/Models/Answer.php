<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'report_id',
        'question_id',
        'user_id',
        'answer',
        'score'
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
    
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function actionplan()
    {
        return $this->hasOne(ActionPlan::class);
    }

    public function attachment()
    {
        return $this->hasOne(Attachment::class);
    }

    public function comment()
    {
        return $this->hasOne(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
