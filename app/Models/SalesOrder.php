<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $fillable = ['customer_name', 'sale_date', 'total_amount'];

    public function items()
    {
        return $this->hasMany(SalesOrderItem::class);
    }
}
