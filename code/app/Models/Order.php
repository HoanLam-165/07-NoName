<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'Order';
    protected $primaryKey = 'OrderID';
    public $timestamps = false;

    protected $fillable = [
        'CustomerID',
        'CategoryID',
        'FromLocation',
        'ToLocation',
        'Total',
        'Charge'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'CustomerID', 'UserID');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID', 'CategoryID');
    }

    public function delivery()
    {
        return $this->hasOne(Delivery::class, 'OrderID', 'OrderID');
    }
}
