<?php

class User
{

    public static function checkName($name)
    {
        if (strlen($name) > 2) {
            return true;
        }
        return false;
    }


    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }


    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    public static function checkSecondPassword($password, $password2)
    {
        if ($password == $password2) {
            return true;
        }
        return false;
    }

    public static function checkEmailExists($email)
    {

        $sql = R::getAll('SELECT * FROM user WHERE email = :email',
          [':email' => $email]);

        if ($sql) {
            return true;
        }

        return false;
    }

    public static function register($login, $email, $password)
    {
        $user = R::dispense('users');
        $user->login = $login;
        $user->email = $email;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        R::store($user);

    }

    public static function checkUserData($email, $password)
    {
        $user = R::findOne('users', 'email = ?', [$email]);

        if ($user) {
            if (password_verify($password, $user->password)) {
                return $user;
            }

            return false;
        }

        return false;
    }

    public static function auth($user)
    {

        $_SESSION['user'] = $user;
    }

    public static function checkLogged()
    {
        if (!isset($_SESSION['user']['id'])) {
            header("Location: /user/auth");
        }

        return $_SESSION['user']['id'];
    }

    public static function isGuest()
    {
        if (!isset($_SESSION['user']['id'])) {
            return true;
        }

        return false;
    }

    public static function getUserById($id)
    {
        return R::findOne('users', 'id = ?', [$id]);
    }

}