<html>
<head>
    <meta charset="utf-8">
    <title>JAVA42-生活倉庫</title>
    <!-- <Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet" type="text/css"/>
    <link href="/css/mycss.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/blurt.min.css">
    <script src="/js/blurt.min.js"></script>
</head>

<body>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a id="home" class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/home">Java42 - 後台管理</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="hello form-control form-control-dark w-75 bg-dark"></div>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap mx-1 w-75">
            <div id="time" class="nav-link px-3 text-white"></div>
        </div>
    </div>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap bg-primary mx-3">
            <a class="nav-link px-3 text-white" href="backOfficelogout">登出</a>
        </div>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column" id="nav_accordion">
                    <li class="nav-item has-submenu">
                        <div th:if="${session.role == 'ADMIN'}">
                            <a class="nav-link dropdown-toggle show" href="#" id="dropdown01" data-bs-toggle="dropdown"
                               aria-expanded="true">權限設定</a>
                            <ul class="submenu collapse" aria-labelledby="dropdown01">
                                <li><a class="dropdown-item users" href="#">使用者維護</a></li>
                                <li><a class="dropdown-item" href="#" id="accountInfo">帳號資訊</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item has-submenu">
                        <div th:if="${session.role == 'ADMIN' or session.role == 'MANAGER'}">
                            <a class="nav-link dropdown-toggle show" href="#" id="dropdown02" data-bs-toggle="dropdown"
                               aria-expanded="true">產品設定</a>
                            <ul class="submenu collapse" aria-labelledby="dropdown02">
                                <li><a class="dropdown-item products" href="http://localhost:8000/BackOffice/products">產品維護</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item has-submenu">
                        <a class="nav-link dropdown-toggle show" href="#" id="dropdown03" data-bs-toggle="dropdown"
                           aria-expanded="true"> 客戶模組 </a>
                        <ul class="submenu collapse" aria-labelledby="dropdown03">
                            <li><a class="dropdown-item members" href="#">客戶資料維護</a></li>
                        </ul>
                    </li>
                    <li class="nav-item has-submenu">
                        <a class="nav-link dropdown-toggle show" href="#" id="dropdown04" data-bs-toggle="dropdown"
                           aria-expanded="true"> 銷售模組 </a>
                        <ul class="submenu collapse" aria-labelledby="dropdown04">
                            <li><a class="dropdown-item orders" href="#">銷售訂單維護</a></li>
                        </ul>
                    </li>
                    <li class="nav-item has-submenu">
                        <a class="nav-link dropdown-toggle show" href="#" id="dropdown05" data-bs-toggle="dropdown"
                           aria-expanded="true"> 報表資訊 </a>
                        <ul class="submenu collapse" aria-labelledby="dropdown05">
                            <li><a class="dropdown-item salesReport" href="#">銷售報表</a></li>
                            <li><a class="dropdown-item productSalesReport" href="#">產品銷售表</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            @if($user[0]->user_role == 'ADMIN')
            <div>
                <div id="Dashboard">
                <br>
                <br>
                <div><h5>登入使用者帳號: <span >{{$user[0]->user_account}}</span></h5></div>
                <div><h5>登入角色: <span>{{$user[0]->user_role}}</span></h5></div>
                <br>
                <br>
                <div><h5>目前正在線上的使用者有:</h5>
                    <button onclick="refreshSessionList()">refresh</button>
                    <table class="table table-info table-hover table-striped w-50">
                        <tr>
                            <th>使用者帳戶</th>
                            <th>使用者角色</th>
                            <th>停留時間</th>
                            <th></th>
                        </tr>
                        <tbody id="sessionUserListData">
                        <!--ajax get session user list and info-->
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            </div>

            <div id="user01" class="d-none" th:insert="th_displayBoUser">
            </div>

            <div id="product01" class="d-none" th:insert="th_displayProductByThymeleaf">
            </div>

            <div id="main_members" class="d-none">
                <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">會員資料維護</h1>
                </div>
                <div>
                    <button class="button-54 m-query"><img src="images/search.png" style="width: 20px" alt="">查詢
                    </button>
                    <div th:if="${session.role == 'ADMIN' or session.role == 'MANAGER'}">
                        <button class="button-54"><img src="images/add.png" style="width: 20px" alt="">新增</button>
                    </div>
                </div>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col" colspan="4">#搜尋條件</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row" style="text-align: end">會員編號</th>
                        <td><input type="text"></td>
                        <td style="text-align: end; font-weight: bold">會員姓名</td>
                        <td><input type="text"></td>
                    </tr>
                    <tr>
                        <th scope="row" style="text-align: end">會員暱稱</th>
                        <td><input type="text"></td>
                        <td scope="row" style="text-align: end;font-weight: bold">會員信箱</td>
                        <td><input type="text"></td>
                    </tr>
                    <tr>
                        <th scope="row" style="text-align: end">會員電話</th>
                        <td><input type="text"></td>
                        <td style="text-align: end"></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div id="memberList" class="d-none">
                <table class="table table-success table-hover table-striped w-100">
                    <thead>
                    <tr>
                        <th scope="col">會員編號</th>
                        <th scope="col">編輯</th>
                        <th scope="col">會員姓名</th>
                        <th scope="col">會員帳號</th>
                        <th scope="col">會員信箱</th>
                        <th scope="col">會員電話</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td><img class="edit" src="images/edit.png" alt=""></td>
                        <td>黃春翰</td>
                        <td>aaa123123</td>
                        <td>haru@gmail.com</td>
                        <td>0912345678</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td><img class="edit" src="images/edit.png" alt=""></td>
                        <td>林宗翰</td>
                        <td>bbb591239</td>
                        <td>han@gmail.com</td>
                        <td>0932456789</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td><img class="edit" src="images/edit.png" alt=""></td>
                        <td>黃柏憲</td>
                        <td>sss1239510</td>
                        <td>sbb@gmail.com</td>
                        <td>0987464313</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div id="order01" class="d-none" th:insert="th_displayOrderByTh">
            </div>

            <div id="SalesReport01" class="d-none" th:insert="th_report_Sales">
            </div>

            <div id="productSalesReport01" class="d-none" th:insert="th_report_ProductSales">
            </div>
        </main>
    </div>
</div>

<script>
    // submenu的JS
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.sidebar .nav-link').forEach(function (element) {
            element.addEventListener('click', function (e) {
                let nextEl = element.nextElementSibling;
                let parentEl = element.parentElement;

                if (nextEl) {
                    e.preventDefault();
                    let mycollapse = new bootstrap.Collapse(nextEl);

                    if (nextEl.classList.contains('show')) {
                        mycollapse.hide();
                    } else {
                        mycollapse.show();
                        // find other submenus with class=show
                        let opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                        // if it exists, then close all of them
                        if (opened_submenu) {
                            new bootstrap.Collapse(opened_submenu);
                        }
                    }
                }
            }); // addEventListener
        }) // forEach
    });

    $(function() {
        refreshSessionList();
    });

    function sessionTerminated(name){
        console.log("name="+name);
        var settings = {
            "url": "http://localhost:8081/api/user/session/kick/"+name,
            "method": "GET",
        };

        $.ajax(settings).done(function(res) {
            blurt(
                'Session Killed',
                '',
                'warning'
            );
            refreshSessionList();
        });
    }

    function refreshSessionList() {
        var settings = {
            "url": "http://localhost:8081/api/user/session_user_list",
            "method": "GET",
        };

        $.ajax(settings).done(function (response) {
            let data = JSON.parse(response);
            let str = '';
            data.forEach(function (e) {
                let aliveSec = Math.floor((Number(Date.now()) - Number(e.createTime)) / 1000) % 60;
                let aliveMin = Math.floor(Math.floor((Number(Date.now()) - Number(e.createTime)) / 1000) / 60);
                console.log(e.userName);
                console.log("role=" + e.userRole);
                console.log("已登入時間=" + aliveSec);
                str = str + `<tr>
                                <td>${e.userName}</td>
                                <td>${e.userRole}</td>
                                <td class="test1993">${aliveMin} 分 ${aliveSec} 秒</td>
                                <td><button onclick="sessionTerminated('${e.sessionId}')">OUT</button></td>
                                </tr>`
            })
            $('#sessionUserListData').html(str);
        });
    }

    setInterval(() => {
        let loginUserName = '[[${session.login}]]';
        const date = new Date();
        document.getElementById("time").innerHTML =
            `Hello ${loginUserName}! 現在時間:` + date.toLocaleTimeString();
    }, 1000);

    $('.users').on('click', function () {
        $('main>div').prop('class', 'd-none')
        $('#user01').removeClass('d-none')
    })
    $('.products').on('click', function () {
        $('main>div').prop('class', 'd-none')
        $('#product01').removeClass('d-none')
    })
    $('.orders').on('click', function () {
        $('main>div').prop('class', 'd-none')
        $('#order01').removeClass('d-none')
    })
    $('.members').on('click', function () {
        $('main>div').prop('class', 'd-none')
        $('#main_members').prop('class', 'd-block')
    })
    $('.m-query').on('click', function () {
        $('#memberList').removeClass('d-none')
    })
    $('.productSalesReport').on('click', function () {
        $('main>div').prop('class', 'd-none')
        $('#productSalesReport01').removeClass('d-none')
        $('#productSalesReportContent').addClass('d-none')
    })
    $('.salesReport').on('click', function () {
        $('main>div').prop('class', 'd-none')
        $('#SalesReport01').removeClass('d-none')
        $('#SalesReportContent').addClass('d-none')
    })
</script>
</body>

</html>