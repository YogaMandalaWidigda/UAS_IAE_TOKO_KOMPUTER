<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected $connection = 'product'; // koneksi ke DB product
    protected $primaryKey = 'product_id'; // GANTI SESUAI NAMA KOLOM DI DATABASE
    protected $connection = 'mysql_PRODUCT';
    protected $table = 'products';
    public $incrementing = true;
    protected $keyType = 'int';
}
