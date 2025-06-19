<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShipmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shipment_type')->insert([
            [
                'name_shipment_type' => 'JNT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_shipment_type' => 'JNE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_shipment_type' => 'TIKI',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_shipment_type' => 'SiCepat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_shipment_type' => 'Ninja Express',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_shipment_type' => 'Pos Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_shipment_type' => 'AnterAja',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name_shipment_type' => 'ID Express',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
