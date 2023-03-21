<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Product</title>
</head>

<body>

    <form method="post" action="{{ route('upload')}}" enctype="multipart/form-data">
        @csrf
        <legend>Product Data</legend>
        <fieldset>
            <label for="product_name">商品名稱：</label>
            <input id="product_name" name="product_name" type="text"> <br>
            <label for="product_catalog">商品類別：</label>
            <input id="product_catalog" name="product_catalog" type="text"> <br>
            <label for="product_price">商品價格：</label>
            <input id="product_price" name="product_price" type="text"> <br>
            <label for="product_stock">商品庫存：</label>
            <input id="product_stock" name="product_stock" type="number"> <br>
            <label for="product_color">商品顏色：</label>
            <input id="product_color" name="product_color" type="text"> <br>
            <label for="product_desc">商品描述：</label>
            <input id="product_desc" name="product_desc" type="text"> <br>
            <label for="product_img1">商品圖片1：</label>
            <input id="product_img1" name="product_img1" type="file" accept="image/gif, image/jpeg, image/png"> <br>
            <label for="product_img2">商品圖片2：</label>
            <input id="product_img2" name="product_img2" type="file" accept="image/gif, image/jpeg, image/png"> <br>
            <label for="product_img3">商品圖片3：</label>
            <input id="product_img3" name="product_img3" type="file" accept="image/gif, image/jpeg, image/png"> <br>
            <label for="product_img4">商品圖片4：</label>
            <input id="product_img4" name="product_img4" type="file" accept="image/gif, image/jpeg, image/png"> <br>
            <label for="okOrCancel"></label>

            <button type="submit" id="okOrCancel" name="okOrCancel">OK</button>
            <button type="submit" id="okOrCancel" name="okOrCancel">Cancel</button>


        </fieldset>
    </form>


</body>

</html>
