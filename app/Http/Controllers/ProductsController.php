<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;



class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ProductList = Products::all();
        return response(
            $ProductList,
            200,
            [
                'Content-Type' => 'application/json'
            ],
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("BackOffice.addProduct");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Products::where('product_name', '=', "$request->product_name")->get();
        // 檢查名稱是否重複
        if ($product == '[]') {
            $imageArray = Array();
            $imageURL = 'https://hankawsbucket20230131.s3.us-west-2.amazonaws.com/projectimage/';
            // 取得照片上傳至s3
            for($i = 1; $i < 5; $i++){
                if($request->file("product_img$i")){
                    $image = $request->file("product_img$i");
                    $ext = $image->extension(); // 取得檔案副檔名
                    date_default_timezone_set("Asia/Taipei");
                    $microtime = microtime(true) * 10000;
                    $image_name = $microtime .  '.' . $ext;
                    $imageArray[$i] = $image_name;
                    $image->storeAs('projectimage/', $image_name, 's3');
                }
                
            }

            Products::insert(
                [
                    'product_name' => "$request->product_name",
                    'product_catalog' => "$request->product_catalog",
                    'product_price' => $request->product_price,
                    'product_stock' => $request->product_stock,
                    'product_color' => $request->product_color,
                    'product_desc' => $request->product_desc,

                    'product_img1' => $imageArray[1]?$imageURL.$imageArray[1]:'',
                    'product_img2' => $imageArray[2]?$imageURL.$imageArray[2]:'',
                    'product_img3' => $imageArray[3]?$imageURL.$imageArray[3]:'',
                    'product_img4' => $imageArray[4]?$imageURL.$imageArray[4]:'',
                    'create_user'=>'Hank',
                    'create_date'=> now(),
                ]
            );
            return redirect("/product");
        } else {
            return response()->json(['success' => 'false', 'message' => 'Product_Name duplicate entry.'], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Product = Products::find($id);
        return response(
            $Product,
            200,
            [
                'Content-Type' => 'application/json'
            ],
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 取得產品資料回傳預設值給前端
        $product = Products::where('product_id', '=', "$id")->get();
        return view("BackOffice.addProduct", ['product' => $product[0]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request )
    {
        $imageURL = 'https://hankawsbucket20230131.s3.us-west-2.amazonaws.com/projectimage/';
        // 取得照片上傳至s3
        for($i = 1; $i < 5; $i++){
            if($request->file("product_img$i")){
                // 如果前端有上傳圖片
                $image = $request->file("product_img$i");
                $ext = $image->extension();
                date_default_timezone_set("Asia/Taipei");
                $microtime = microtime(true) * 10000;
                $image_name = $microtime .  '.' . $ext;
                $image->storeAs('projectimage/', $image_name, 's3');
                Products::where('product_id', '=', "$id")->update(
                    [
                        "product_img$i" => $imageURL.$image_name,
                    ]
                );
            }
            
        }

        Products::where('product_id', '=', "$id")->update(
            [
                'product_name' => "$request->product_name",
                'product_catalog' => "$request->product_catalog",
                'product_price' => $request->product_price,
                'product_stock' => $request->product_stock,
                'product_color' => $request->product_color,
                'product_desc' => $request->product_desc,
                'update_user' => 'Hank',
                'update_date' => now()
            ]
        );
        return "updated";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Product = Products::find($id);
        $Product->delete();
        return "Product is deleted.";
    }
}
