<?php


namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Validator;
use App\Models\Orders;
use Symfony\Component\HttpKernel\Exception\HttpException;

class OrdersController extends Controller
{

    public function list_orders()
    {
        return Orders::list_orders();
    }


}
