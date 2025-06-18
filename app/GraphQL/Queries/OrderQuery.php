<?php
namespace App\GraphQL\Queries;

use App\Models\Order;

class OrderQuery
{
    public function getByCustomerId($_, array $args)
    {
        return Order::where('customer_id', $args['customer_id'])->get();
    }
}
