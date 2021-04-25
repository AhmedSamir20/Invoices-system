<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $fillable = ['Product_name','section_id','description'];
    protected $hidden = ['created_at', 'updated_at'];
    public $timestamps = true;

    public function section()
    {
        return $this->belongsTo(Section::class,'section_id');
    }
}
