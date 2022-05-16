<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreLocationType extends Model
{
    use HasFactory;

    public function site()
    {
        return $this->hasMany(Site::class);
    }
}
