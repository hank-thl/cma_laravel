<?php

namespace App\Http\Controllers;
use App\Models\Products;

use Illuminate\Http\Request;

class CartController extends Controller
{
    
    function addToCart($id, $qty)
    {
        // session()->forget('cart');
        $product = Products::find($id);
        $cart = session()->get('cart','');
        $duplicateItem = 0;
        
        if($cart){
            // 如果購物車內有商品
            foreach($cart as $i => $x){
                if($id == $x['id']){
                    // 如果購物車內已有同樣商品
                    $cart[$i]['qty'] += $qty;
                    $cart[$i]['singleTotal'] += ($x['price'] * $qty);
                    $duplicateItem = 1;
                }
            }
            if($duplicateItem){
                // 如果購物車內有同樣商品
                session()->forget('cart'); 
                // 先清空購物車，再將更改過數量的$cart放回購物車
                foreach($cart as $item){
                    session()->push('cart', $item);
                }
                $content = session()->get('cart');
                return response(
                    $content,
                    200,
                    [
                        'Content-Type' => 'application/json'
                        ]
                    );
                
            }

            // 如果購物車內沒有同樣商品，則建立item放入購物車
            $item = array(
                'id' => $product->product_id,
                'name' => $product->product_name,
                'image_url' => $product->product_img1,
                'price' => $product->product_price,
                'singleTotal' => ($product->product_price * $qty),
                'qty' => ($qty*1)
                );
            
            session()->push('cart', $item);

        }else{
            // 如果購物車是空的，建立item放入購物車

            $item = array(
                'id' => $product->product_id,
                'name' => $product->product_name,
                'image_url' => $product->product_img1,
                'price' => $product->product_price,
                'singleTotal' => ($product->product_price * $qty),
                'qty' => ($qty*1)
                );
                session()->push('cart', $item);
        }
        $content = session()->get('cart');
        return response(
            $content,
            200,
            [
                'Content-Type' => 'application/json'
                ]
            );
    }

    function removeProduct($id){
        $cart = session()->get('cart','');
        $hasItem = 0;
        foreach($cart as $i => $x){
            // 檢查購物車內是否有要移除的商品
            if($id == $x['id']){
                array_splice($cart,$i,1);  // 從購物車內移除商品
                $hasItem=1; // 紀錄有要移除的商品
            }
        }
        if($hasItem){
            session()->forget('cart');
            // 先清空購物車，再將更改過的$cart放入購物車
            foreach($cart as $item){
                session()->push('cart', $item);
            }
        }
        
        return session()->get('cart','');

        
    }

    function checkout(){
        // 取得並回傳購物車
        $content = session()->get('cart','');
        return response(
            $content,
            200,
            [
                'Content-Type' => 'application/json'
                ]
            );
    }

    function reduceProduct($id,$qty){
        $cart = session()->get('cart','');
        $hasItem = 0;
        foreach($cart as $i => $x){
            // 檢查購物車內是否有要減少的商品
            if($id == $x['id']){
                if($cart[$i]['qty'] > 1){
                    // 減少購物車內的數量及價格
                    $cart[$i]['qty'] -= $qty;
                    $cart[$i]['singleTotal'] -= ($x['price'] * $qty);
                }else{
                    // 當購物車內只剩一件商品
                    array_splice($cart,$i,1);  // 從購物車內移除商品
                }
                $hasItem=1;
            }
        }
        if($hasItem){
            // 先清空購物車，再將更改過的$cart放入購物車
            session()->forget('cart');
            foreach($cart as $item){
                session()->push('cart', $item);
            }
        }
        
        return session()->get('cart','');
    }

    function clearCart(){
        // 清空Session中的購物車
        session()->forget('cart');
        return redirect('/');
    }
}
