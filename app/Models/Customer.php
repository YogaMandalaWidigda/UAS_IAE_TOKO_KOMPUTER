<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $connection = 'mysql_CUSTOMER'; // koneksi ke DB customer
    protected $primaryKey = 'customer_id'; // GANTI SESUAI NAMA KOLOM DI DATABASE
    protected $table = 'customers';
    public $incrementing = true;
    protected $keyType = 'int';
}
