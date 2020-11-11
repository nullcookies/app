<?php
require_once(ROOT.'/template/header.php');
?>
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <h2 class="title text-center">Регистрация пользователя</h2>
                <div class="col-sm-4 center-block center-block-float-none">
                    <? if ($result): ?>
                        <div class="alert alert-success">Вы успешно зарегестрированы!</div>
                    <? else: ?>
                        <div class="signup-form"><!--sign up form-->
                            <? if (count($reqisterErrors) > 0): ?>
                                <div class="alert alert-danger">
                                    <? foreach ($reqisterErrors as $error): ?>
                                        <p>- <?= $error; ?></p>
                                    <? endforeach; ?>
                                </div>
                            <? endif; ?>
                            <form action="/user/register" method="post">
                                <input type="text" name="name" placeholder="Имя" value="<?= $name ?>"/>
                                <input type="email" name="email" placeholder="Email" value="<?= $email ?>"/>
                                <input type="password" name="password" placeholder="Пароль" value=""/>
                                <input type="password" name="password2" placeholder="Повторите пароль" value=""/>
                                <input type="submit" name="submit" value="Регистрация"
                                       class="btn btn-success btn-block">
                            </form>
                        </div><!--/sign up form-->
                    <? endif; ?>

                    <div style="margin-top: 30px;"><a href="/user/auth"
                                                      class="btn btn-default btn-block">Авторизация</a></div>
                </div>
            </div>
        </div>
    </section><!--/form-->
<?
require_once(ROOT.'/template/footer.php');
?>