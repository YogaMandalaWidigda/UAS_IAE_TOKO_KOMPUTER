<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'product_id',
        'customer_name',
        'product_name',
        'quantity',
        'price',
        'total_price',
        'payment_methods',
        'payment_id',
        'name_shipment_type',
        'shipment_types',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

   public function shipment()
    {
    return $this->belongsTo(ShipmentType::class, 'shipment_types', 'shipment_types');

    }
}