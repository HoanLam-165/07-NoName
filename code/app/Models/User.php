<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class User extends Model
{
    use HasFactory;
    protected $table = 'User';
    protected $primaryKey = 'UserID';

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'UserRole', 'UserID', 'RoleID');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'CustomerID');
    }

    public function deliveriesAsStaff()
    {
        return $this->hasMany(Delivery::class, 'StaffID');
    }

    public function deliveriesAsManager()
    {
        return $this->hasMany(Delivery::class, 'ManagerID');
    }
}