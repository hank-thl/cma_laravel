<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Java42eeit Backoffice</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
            crossorigin="anonymous"></script>
    <!-- Custom styles for this template -->
    <link href="/css/signin.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="text-center">

<main class="form-signin">
    <form method='post' action='BackOffice'>
        @csrf
        <img class="mb-4" src="/images/fist.png" alt="image" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">歡迎使用後台系統</h1>

        <div class="form-floating">
            <input type="username" class="form-control" id="floatingInput" name='username' placeholder="使用者帳號">
            <label for="floatingInput">帳號</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" name='password' placeholder="密碼">
            <label for="floatingPassword">密碼</label>
        </div>

        <button id="btnLogin" class="w-100 btn btn-lg btn-primary mb-2" type="submit">登入</button></input>
        <div style="color: red" th:text="${login}"></div>
        <div style="color: red" th:text="${username}"></div>
        <div style="color: red" th:text="${password}"></div>
        <div class="checkbox mb-3">
            <label>
                <a href="#">忘記密碼?</a>
            </label>
        </div>
        <p class="mt-5 mb-3 text-muted">&copy; EEIT42_2017–2021</p>
    </form>
</main>
<script>
    $(document).keyup(function (event) {
        console.log(event);
        if (event.keyCode == 13) {
            $("#btnLogin").trigger("click");
        }
    });
</script>
</body>
</html>