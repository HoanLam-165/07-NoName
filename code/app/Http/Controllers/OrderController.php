<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function search(Request $request)
    {
        $roleId = $request->input('RoleID');  
        $status = $request->input('Status');  
        $category = $request->input('Category');
        $customerId = $request->input('CustomerID');

        // Kiểm tra quyền
        if (empty($roleId)) {
            return response()->json(['message' => "Không có quyền truy cập"], 403);
        }

        // Query với join
        $query = Order::query()
            ->leftJoin('Delivery', 'Order.OrderID', '=', 'Delivery.OrderID')
            ->leftJoin('Category', 'Order.CategoryID', '=', 'Category.CategoryID')
            ->select(
                'Order.*',
                'Order.CustomerID as CustomerID',
                'Delivery.Status as DeliveryStatus',
                'Delivery.CurrentLocation',
                'Category.CategoryName'
            );

        // Nếu role là Customer (RoleID = 2) thì lọc theo CustomerID
        if ($roleId == 2 && $customerId) {
            $query->where('Order.CustomerID', $customerId);
        }

        // Lọc theo trạng thái giao hàng
        if (!empty($status)) {
            $query->where('Delivery.Status', $status);
        }

        // Lọc theo Category (ID hoặc tên)
        if (!empty($category)) {
            if (is_numeric($category)) {
                $query->where('Order.CategoryID', $category);
            } else {
                $query->where('Category.CategoryName', 'like', "%$category%");
            }
        }

        $orders = $query->get();

        // Nếu không có đơn hàng
        if ($orders->isEmpty()) {
            return response()->json(['message' => 'Không tìm thấy đơn hàng.'], 404);
        }

        return response()->json(['orders' => $orders], 200);
    }
}