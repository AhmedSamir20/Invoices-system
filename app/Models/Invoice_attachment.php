<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice_attachment extends Model
{

    protected $table='invoice_attachments';
    protected $guarded=[];
    protected $hidden =['created_at','updated_at'];
    public $timestamps = true;
}
