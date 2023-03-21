<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function createOrder(Request $request){
        date_default_timezone_set("Asia/Taipei");   // 設置時區
        $deliveredDate = date('Y-m-d H:i:s', strtotime('+3 day'));  // 訂單成立3日後
        
        $cart = session()->get('cart','');
        session()->forget('cart');
        // 講訂單資料存入資料庫
        Order::insert(
            [
                'order_id' => $request->orderId,
                'member_id' => $request->memberId,
                'pay_method' => $request->payMethod,
                'status' => "已成立",
                'delivered_date' => "$deliveredDate",
                'deliver_cvs' => "$request->deliverCvs",
                'deliver_addr' => "$request->deliverAddr",
                'received_date' => now(),
                'create_date' => now(),
                'create_user' => 'Hank',
                
            ]
        );
        
        // 將購物車商品存入資料庫
        foreach($cart as $item){
            OrderDetail::insert(
                [
                    'order_id' => $request->orderId,
                    'product_id' => $item['id'],
                    'unit_price' => $item['price'],
                    'quantity' => $item['qty'],            
                ]
            );
        }

        return response("訂單已成立",201);
    }
    function getOrders(){

        // 訂單編號 訂單日期 付款方式 到貨超商 宅配地址 訂單總額 狀態
        $member = session()->get('member','');  // 取得會員資料
        // 從資料庫取出會員的所有訂單資料
        $memberOrders = Order::where('member_id', '=', $member->member_id)->get();
        
        $orderList = Array();
        foreach($memberOrders as $order){
            // 從資料庫取出單筆訂單的詳細資料
            $orderDetail = OrderDetail::where('order_id', '=', $order->order_id)->get();
            $sum = 0;
            foreach($orderDetail as $item){
                // 計算單筆訂單的訂單總價
                $sum += ($item->unit_price*$item->quantity);
            }
            $singleOrder = array(
                'orderId' => $order->order_id,
                'createDate' => $order->create_date,
                'payMethod' => $order->pay_method,
                'deliverCvs' => $order->deliver_cvs,
                'deliverAddr' => $order->deliver_addr,
                'orderTotalAmount' => $sum,
                'status' => $order->status
                );
            // 將統整後的訂單資料存入orderList
            array_push($orderList,$singleOrder);
        }
        return response()->json($orderList,200);
    }
}
