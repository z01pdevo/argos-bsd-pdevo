<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'answer_id',
        'url',
        'size',
        'type',
    ];

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
