<?php

class UserController
{

    public function actionRegister()
    {
        if (!User::isGuest()) {
            header('Location: /user/profile');
        }

        $reqisterErrors = [];

        if (isset($_POST['submit'])) {

            $name = $_POST['name'];
            if (!User::checkName($name)) {
                $reqisterErrors[] = 'Имя пользователя должно быть больше 2-х символов!';
            }


            $email = $_POST['email'];
            if (!User::checkEmail($email)) {
                $reqisterErrors[] = 'Поле email заполнен не корректно!';
            }


            $email = $_POST['email'];
            if (User::checkEmailExists($email)) {
                $reqisterErrors[] = 'Пользователь с таким email адресом существует!';
            }


            $password = $_POST['password'];
            if (!User::checkPassword($password)) {
                $reqisterErrors[] = 'Пароль должен быть больше 5-ти символов!';
            }

            $password2 = $_POST['password2'];
            if (!User::checkSecondPassword($password, $password2)) {
                $reqisterErrors[] = 'Пароль и повторный пароль не совпадает!';
            }


            if (count($reqisterErrors) == 0) {
                $result = User::register($name, $email, $password);
            }
        }

        require_once(ROOT.'/views/user/register.php');
        return true;
    }


    public function actionAuth()
    {
        if (!User::isGuest()) {
            header('Location: /user/profile');
        }

        $authErrors = [];

        if (isset($_POST['submit'])) {


            $email = $_POST['email'];
            if (!User::checkEmail($email)) {
                $authErrors[] = 'Поле email заполнен не корректно!';
            }

            $password = $_POST['password'];
            if (!User::checkPassword($password)) {
                $authErrors[] = 'Пароль должен быть больше 5-ти символов!';
            }

            if (count($authErrors) == 0) {

                $result = User::checkUserData($email, $password);

                if ($result) {
                    User::auth($result);
                    Header("Location: /user/profile");
                } else {
                    $authErrors[] = 'Введенные данные не верны!';
                }
            }
        }

        require_once(ROOT.'/views/user/auth.php');
        return true;
    }

    public function actionProfile()
    {
        $userId = User::checkLogged();
        $images = R::getAll('select * from images where user_id = :user_id',
          [':user_id' => $userId]);
        require_once(ROOT.'/views/user/profile.php');
        return true;
    }

    public function actionLogout()
    {
        unset($_SESSION["user"]);
        header("Location: /");
    }

}