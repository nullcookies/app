<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Главная</title>
    <link href="/template/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template/css/light-box.css" rel="stylesheet">
    <link href="/template/css/app.css" rel="stylesheet">


    <script defer src="/template/js/brands.min.js"></script>
    <script defer src="/template/js/solid.min.js"></script>
    <script defer src="/template/js/fontawesome.min.js"></script>


    <link rel="shortcut icon" href="images/favicon.ico">
</head><!--/head-->

<body>
<header id="header"><!--header-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="/"><img src="/template/images/home/logo.png" alt=""/></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <? if (User::isGuest()): ?>
                                <li><a href="/user/auth"><i class="fa fa-lock"></i> Авторизация</a></li>
                            <? else: ?>
                                <li><a href="/user/profile"><i class="fa fa-user"></i> Аккаунт</a></li>
                                <li><a href="/user/logout"><i class="fa fa-unlock"></i> Выход</a></li>
                            <? endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

</header><!--/header-->