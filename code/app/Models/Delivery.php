<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = 'delivery';
    protected $primaryKey = 'DeliveryID';
    public $timestamps = false;

    protected $fillable = [
        'OrderID',
        'StaffID',
        'ManagerID',
        'Status',
        'CurrentLocation'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'OrderID', 'OrderID');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'StaffID', 'UserID');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'ManagerID', 'UserID');
    }
}
