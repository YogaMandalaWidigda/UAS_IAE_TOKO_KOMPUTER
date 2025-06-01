<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $payments = [
            'BCA',
            'BNI',
            'MANDIRI',
            'OVO',
            'GOPAY',
            'ShopeePay',
            'QRIS',
            'Cash on Delivery',
        ];

        $data = [];

        foreach ($payments as $index => $method) {
            $data[] = [
                'id' => $index + 1,
                'payment_methods' => $method,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('payments')->insert($data);
    }
}
