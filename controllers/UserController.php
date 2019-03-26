<?php

class UserController {

    /**
     * Регистрируем нового пользователя
     */
    public function actionRegister() {
        User::checkLogged();
        $result = false;
        $name = '';
        $email = '';
        $phone = '';
        $password = '';

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $result = User::register($name, $email, $password);

        }

        require_once(ROOT.'/views/user/register.php');

        return true;
    }
    /**
     * Вход на сайт
     */
    public function actionLogin() {
        $email = '';
        $password = '';
        $errors = [];

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];


            $userId = User::checkUserData($email, $password);

            if (!$userId) {
                $errors[] = 'Неверный логин или пароль. Попробуйте еще раз';
            }
            else {
                User::auth($userId);
                header('Location: /');
            }
        }
        require_once(ROOT.'/views/user/login.php');

        return true;
    }

    public function actionLogout() {
        unset($_SESSION['user']);
        header('Location: /');
    }
}