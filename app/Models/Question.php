<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_group_id',
        'text',
        'max_score',
        'importance',
        'order',
        'active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deactivated_at' => 'datetime'
    ];

    public function questionGroup()
    {
        return $this->belongsTo(QuestionGroup::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }


}
