<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentType extends Model
{
    protected $connection = 'shipment'; // Sesuaikan dengan koneksi yang Anda definisikan di config/database.php
    protected $table = 'shipment_type'; // ✅ perbaikan dari 'shipment_types'
    protected $primaryKey = 'shipment_types'; // ✅ sesuaikan dengan nama kolom ID di database

    protected $fillable = [
        'name_shipment_type',
    ];

    public $timestamps = true; // Karena ada created_at dan updated_at
}
