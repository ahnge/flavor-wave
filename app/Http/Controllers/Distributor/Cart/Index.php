<?php

namespace App\Http\Controllers\Distributor\Cart;

use App\Constants\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Mail\SendOrderAlert;
use App\Models\Region;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Index extends Controller {
    public  function  index( Request $request ) {
        $cartIds = $request->query( 'cartList' );
        $cartIds = explode( ',', $cartIds );
        $products = \App\Models\Product::whereIn( 'id', $cartIds )->get();
        $user  = auth()->user();
        $regions = Region::all();
        return view( 'web.distributor.cart.index', compact( [ 'products' ,'regions','user'] ) );
    }

    public function order( Request $request ) {

        DB::beginTransaction();
        try {

            $cartData = $request->cartData;
            $user = auth()->user();

            $order = $this->saveOrder($request,$user);
            $total = 0;
            $total = $this->saveOrderProduct($order,$cartData,$total);
            $order->total = $total;
            $order->update();

            Mail::to(config('control.hostMail'))->queue(new SendOrderAlert( $order, $user->email ) );

            DB::commit();
            return response()->json( [
                'success'=>true,
                'data' => $order
            ] );
        } catch( \Exception $e ) {
            DB::rollBack();
            return response()->json( [
                'success'=>true,
                'message' => $e
            ],422);
        }

    }

    protected function saveOrder($request,$user)
    {
        $order = new Order();
            $order->order_no  = 'ORD-'.rand( 100000, 999999 );
            $order->is_urgent = request('isUrget') == 'true' ? 1 : 0;
            $order->distributor_id = $user->id;
            $order->address = $request->address;
            $order->phone_no= $request->phone_number;
            $order->region_code = $request->region;
            $order->status = OrderStatusEnum::Pending->value;
            $order->total =  0;
            $order->due_date = date( 'Y-m-d', strtotime( '+3 days' ) );
            $order->save();

        return $order;
    }

    protected  function saveOrderProduct($order,$cartData,$total)
    {
        foreach ( $cartData as $cart ) {
            $product = \App\Models\Product::findOrFail( $cart[ 'productId' ] );

            OrderProduct::create( [
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $cart[ 'productQuantity' ],
            ] );

            $product_price = $product->price * $cart[ 'productQuantity' ];
            $total += $product_price;
        }
        return $total;
    }
}
