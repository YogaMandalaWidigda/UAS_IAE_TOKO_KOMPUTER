<?php

namespace App\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;

final class UpdateProductValidator extends Validator
{
    public function rules(): array
    {
        return [
            'input.product_name' => ['sometimes', 'string'],
            'input.brand' => ['sometimes', 'string'],
            'input.chategory' => ['sometimes', 'string'],
            'input.price' => ['sometimes', 'integer'],
            'input.stock' => ['sometimes', 'integer'],
        ];
    }
}
