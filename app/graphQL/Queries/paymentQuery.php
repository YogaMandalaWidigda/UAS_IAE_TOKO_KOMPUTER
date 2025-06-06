<?php

namespace App\GraphQL\Queries;

use App\Models\Payment;

class PaymentQuery
{
    // Ambil semua payment
    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return Payment::all();
    }

    // Ambil payment berdasarkan ID
    public function find($_, array $args): ?Payment
    {
        return Payment::find($args['id']);
    }
}
