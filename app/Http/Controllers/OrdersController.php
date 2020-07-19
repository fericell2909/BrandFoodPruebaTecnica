<?php

namespace App\Http\Controllers;
use App\Models\Orders;
use Pusher\Pusher;
use Illuminate\Http\Request;
use App\Events\SendMessageEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class OrdersController extends Controller
{
    private $app_id;
    private $app_key;
    private $app_secret;
    private $app_cluster;

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function registerorder(Request $request , Auth $auth)
    {

        $data = $request->all();

        $reply_message = "";
        $new_code = 0;
        $orders = [];

        Orders::save_order($data, Auth::user()->id , $reply_message , $new_code , $orders);

        if( $new_code > 0 )
        {

            $pusher = new Pusher( env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), array('cluster' => env('PUSHER_APP_CLUSTER')));

            $pusher->trigger('message.orders', 'SendMessageEvent', $orders);

            return json_encode(Array('message' => $reply_message,"error" => '1'));

        } else
        {
            return json_encode(Array('message' => $reply_message,"error" => '1'));
        }



    }

    public function show()
    {
        return view('orders.orders');
    }

}
