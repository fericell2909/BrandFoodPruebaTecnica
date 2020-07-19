<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSentEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class OrdersController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function registerorder()
    {
       // $user = Auth::user();
        $message = 'Mensaje de Prueba';
        
        //broadcast(new MessageSentEvent('Hola', 'Mensaje'))->toOthers();
       
        //broadcast(new MessageSentEvent(Auth::user(),$message))->
        
        //event(new MessageSentEvent(Auth::user(),$message));
        
        $broadcast_data['first_name'] = 'John';
        $broadcast_data['last_name'] = 'Doe';
        $return_socket['data'] = $broadcast_data;

        Event::fire(new MessageSentEvent(Auth::user(),$message));
        

        return $message;
    }

    public function show()
    {
        return view('orders.orders');
    }

}
