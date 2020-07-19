<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Validator;
use App\Models\Products;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ProductController extends Controller
{
    public function list_products()
    {
            
        return Products::list_products();

    }

}
