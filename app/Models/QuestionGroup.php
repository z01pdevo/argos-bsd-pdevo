<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionGroup extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text',
        'helper_text',
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

    public function reports()
    {
        return $this->belongsToMany(Report::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('order', 'asc');
    }
}
