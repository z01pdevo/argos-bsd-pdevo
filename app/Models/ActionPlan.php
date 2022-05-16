<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionPlan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'answer_id',
        'text',
        'compromise_at',
        'done',
        'done_by_id',
        'who',
        'importance',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'compromise_at' => 'datetime'
    ];

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
