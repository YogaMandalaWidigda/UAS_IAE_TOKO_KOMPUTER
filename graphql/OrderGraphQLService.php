<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OrderGraphQLService
{
    protected $orderServiceGraphqlUrl;

    public function __construct()
    {
        $this->orderServiceGraphqlUrl = config('services.order_service.graphql_url');
    }

    public function getAllOrders()
    {
        $query = <<<'GRAPHQL'
        query {
            orders {
                order_id
                customer_id
                product_id
                quantity
                customer_name
                product_name
                price
                total_price
                created_at
                updated_at
            }
        }
        GRAPHQL;

        $response = Http::post($this->orderServiceGraphqlUrl, [
            'query' => $query,
        ]);

        return $response->json('data.orders');
    }
}