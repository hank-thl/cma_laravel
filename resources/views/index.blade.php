<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <script>
        fetch('http://127.0.0.1:8000/product')
            .then(function(response) {
                return response.json();
            })
            .then(function(myJson) {
                console.log(myJson);
            });
        
    </script>
</body>
</html>