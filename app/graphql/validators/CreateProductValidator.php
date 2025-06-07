<?php

namespace App\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;

final class CreateProductValidator extends Validator
{
    public function rules(): array
    {
        return [
            'input.product_name' => ['required', 'string'],
            'input.brand' => ['required', 'string'],
            'input.chategory' => ['required', 'string'],
            'input.price' => ['required', 'integer'],
            'input.stock' => ['required', 'integer'],
        ];
    }
}
