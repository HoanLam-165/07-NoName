<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    protected $table = 'charge';
    protected $primaryKey = 'ChargeID';
    public $timestamps = false;

    protected $fillable = ['CategoryID', 'Unit', 'UnitCharge'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID', 'CategoryID');
    }
}
