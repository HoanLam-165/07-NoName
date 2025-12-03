<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Category extends Model
{
     use HasFactory;

    protected $table = 'category';
    protected $primaryKey = 'CategoryID';
    public $timestamps = false;

    protected $fillable = ['CategoryName', 'Description'];

    public function charges()
    {
        return $this->hasMany(Charge::class, 'CategoryID', 'CategoryID');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'CategoryID', 'CategoryID');
    }
}
