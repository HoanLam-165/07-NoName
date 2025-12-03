<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'RoleID';
    public $timestamps = false;

    protected $fillable = ['RoleName'];

    // Quan hệ: 1 Role có nhiều User thông qua UserRole
    public function users()
    {
        return $this->belongsToMany(User::class, 'userrole', 'RoleID', 'UserID');
    }
}
