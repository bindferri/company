<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'limit'
    ];

    protected $appends = ['is_available'];


    public function setUuidAttribute()
    {
        $this->attributes['uuid'] = Uuid::uuid4()->toString();
    }

}
