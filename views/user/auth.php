<?php
require_once(ROOT.'/template/header.php');
?>
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <h2 class="title text-center">Авторизация пользователя</h2>
                <div class="col-sm-4 center-block center-block-float-none">
                    <div class="signup-form"><!--sign up form-->
                        <? if (count($authErrors) > 0): ?>
                            <div class="alert alert-danger">
                                <? foreach ($authErrors as $error): ?>
                                    <p>- <?= $error; ?></p>
                                <? endforeach; ?>
                            </div>
                        <? endif; ?>
                        <form action="/user/auth" method="post">
                            <input type="email" name="email" placeholder="Email" value="<?= $email ?>"/>
                            <input type="password" name="password" placeholder="Пароль" value=""/>
                            <input type="submit" name="submit" value="Войти" class="btn btn-success btn-block">
                        </form>

                        <div style="margin-top: 30px;"><a href="/user/register" class="btn btn-default btn-block">Регистрация</a>
                        </div>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
<?
require_once(ROOT.'/template/footer.php');
?>