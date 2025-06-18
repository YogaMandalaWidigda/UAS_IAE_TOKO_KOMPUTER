<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $connection = 'payment'; // gunakan koneksi payment
    protected $table = 'payments';
    protected $fillable = ['payment_method'];
    public $timestamps = false;
}


