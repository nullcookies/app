<?php
require_once(ROOT.'/template/header.php');
?>
    <section class="page">
        <div class="container">
            <div class="row">
                <?php if (isset ($_SESSION['user'])) : ?>
                    Авторизован! <br/>
                    Привет, <?php echo $_SESSION['user']->login; ?>!<br/>

                    <a href="/user/logout">Выйти</a>
                <?php else : ?>
                    <h2 class="title text-center">Вы не авторизованы</h2>
                    <a href="/user/auth">Авторизация</a>
                    <a href="/user/register">Регистрация</a>
                <?php endif; ?>
            </div>
        </div>
    </section>


<?
require_once(ROOT.'/template/footer.php');
?>