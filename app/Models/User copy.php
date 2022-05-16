<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'uid',
        'name',
        'email',
        'country',
        'manager_email',
        'photourl',
        'jobname',
        'password',
        'token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'allFedidInfo'      => 'object',
    ];

    public static function find($id)
    {
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
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
        return $this->hasMany(Answer::class);
    }
}
