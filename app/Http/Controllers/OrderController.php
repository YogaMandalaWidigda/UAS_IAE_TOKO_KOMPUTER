<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderGraphQLService; // Jika menggunakan service ini
use App\Models\Order;


class OrderController extends Controller
{
    // Mendapatkan data order dari Order Service menggunakan GraphQL
public function getAllOrders(OrderGraphQLService $orderGraphQLService)
{
    
    $orders = $orderGraphQLService->getAllOrders();
    return response()->json($orders);
    
}

    // Mendapatkan data order berdasarkan customer_id
    public function getOrderFromOrderService($customerId, OrderGraphQLService $orderGraphQLService)
    {
        $orders = $orderGraphQLService->getOrdersByCustomer($customerId);
        return response()->json($orders);
    }

    
}