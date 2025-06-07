<?php

namespace App\GraphQL\Queries;

use App\Models\Product;

class ProductQuery
{
    public function all($_, array $args)
    {
        return Product::all();
    }

    public function find($_, array $args)
    {
        return Product::findOrFail($args['id']);
    }
}
