<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice_detail extends Model
{


    protected $fillable = [
        'id_Invoice',
        'invoice_number',
        'product',
        'Section',
        'status',
        'value_status',
        'note',
        'user',
        'Payment_Date',
    ];
    protected $hidden = ['created_at', 'updated_at'];
    public $timestamps = true;
}
