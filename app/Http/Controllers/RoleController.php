<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function getRole(Request $request) {
        $roleid = $request->input('RoleID');

        $role = Role::find($roleid);

        if(!$role) return response()->json([
            'message' => 'bạn không được xem',
        ], 404);

        return response()->json([
            'role' => $role,
            'message' => 'Xác nhận thành công'
        ], 200);
    }
}
