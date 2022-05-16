<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'site',
        'type',
        'name',
        'manager_email',
        'exploitation_email',
        'active'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deactivated_at' => 'datetime',
        'opened_at'  => 'date:d-m-Y',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function store_location_type()
    {
        return $this->belongsTo(StoreLocationType::class);
    }

    public function store_estate_type()
    {
        return $this->belongsTo(StoreEstateType::class);
    }

    public function actionplans()
    {
        return $this->hasManyDeep(ActionPlan::class, [
                                                        Report::class,
                                                        Answer::class
                                                    ]);
    }

    public function answers()
    {
        return $this->hasManyDeep(Answer::class, [
                                                    Report::class
                                                ]);
    }


}
