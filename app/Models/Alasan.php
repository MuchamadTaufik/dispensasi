<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alasan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function dispensasi()
    {
        return $this->hasMany(Dispensasi::class);
    }
}