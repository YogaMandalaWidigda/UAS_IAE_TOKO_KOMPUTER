<?php

namespace App\GraphQL\Mutations;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductMutation
{
    public function create($_, array $args)
    {
        $validator = Validator::make($args, [
            'product_name' => 'required|string',
            'brand' => 'required|string',
            'chategory' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        if ($validator->fails()) {
            throw new \Exception(json_encode($validator->errors()->all()));
        }

        return Product::create($args);
    }

    public function update($_, array $args)
    {
        $product = Product::findOrFail($args['product_id']);
        $product->update($args);
        return $product;
    }

    public function delete($_, array $args)
    {
        $product = Product::findOrFail($args['product_id']);
        $product->delete();
        return "Product deleted successfully.";
    }
}