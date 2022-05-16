<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Question\Question;

class Report extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    use \Znck\Eloquent\Traits\BelongsToThrough;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'score',
        'max_score',
        'site_id',
        'user_id',
        'time_active',
        'to_dda',
        'to_progression',
    ];

    protected $casts = [
        'time_active' => 'date:hh:mm',
        'result' => 'float',
    ];

    public function actionplans()
    {
        return $this->hasManyDeep(ActionPlan::class, [
                                                        Answer::class
                                                    ]);
    }

    public function comments()
    {
        return $this->hasManyDeep(Comment::class, [
                                                        Answer::class
                                                    ]);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
