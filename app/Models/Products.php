<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    public $primarykey = 'id';

    public static function list_products()
    {
        
        return Products::select("id","description","link_image AS linkimage")->where('state_id',1)->get();

    }
}
