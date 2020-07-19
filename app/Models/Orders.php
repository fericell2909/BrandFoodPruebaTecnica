<?php

namespace App\Models;

use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as DB;

class Orders extends Model
{
    protected $table = 'orders';
    public $primarykey = 'id';

    public static function save_order($data, $user_id , &$reply_message , &$new_code , & $orders)
    {

        try {

            DB::beginTransaction();

            	// Insert in Table :  orders.
            	$new_code = DB::table('orders')->insertGetId(
		     			[
		     				'order_date' => date_create()->format('Y-m-d'),
							'user_id' => $user_id,
							'created_at' =>  date_create()->format('Y-m-d H:i:s'),
							'updated_at' =>  date_create()->format('Y-m-d H:i:s'),
							'state_id' => 1,
		     			]
				 	);

               $records_count = count($data);

                // Insert in Detail.


            	  for ($i=0; $i < $records_count; $i++) {

               		$order_detail = new OrderDetail();

                       $order_detail->order_id =  $new_code;
                       $order_detail->product_id = $data[$i]['id'];
                       $order_detail->quantity = $data[$i]['quantity'];
                       $order_detail->created_at = date_create()->format('Y-m-d H:i:s');
                       $order_detail->updated_at = date_create()->format('Y-m-d H:i:s');

               		   $order_detail->save();

                    }

            	DB::commit();

                $reply_message = 'Se Genero su Pedido Correctamente. Su Numero de Pedido es : '.$new_code;
                $orders =  Orders::list_orders();

    	} catch (\Exception $e) {
            DB::rollback();

            $reply_message = 'No se puedo Grabar la informacion. Por Favor Vuelta a Intentar en unos Minutos. ' . $e->getMessage();
            $new_code = -1;

        }
    }

    static public function list_orders()
    {

        $orders = Orders::select(DB::raw("orders.id as id , orders.order_date as orderdate ,
                                           users.name AS username ,
                                           stateorders.description as statedescription ,
                                           SUM(orders_detail.quantity) as quantity"))
                            ->join('users','users.id','=','orders.user_id')
                            ->join('stateorders','stateorders.id','=','orders.state_id')
                            ->join('orders_detail','orders_detail.order_id','=','orders.id')
                            ->orderBy('orders.id', 'desc')
                            ->groupBy('orders.id','orders.order_date','users.name','stateorders.description')
                            ->get();

        return $orders;

    }
}
