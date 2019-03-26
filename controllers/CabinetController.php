<?php

class CabinetController {
    /**
     * Экшн для редактирования данных
     */
    public function actionEdit() {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);

        $name = $user['name'];
        $email = $user['email'];
        $password = $user['password'];

        $result = false;

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $result = User::edit($userId, $name, $email, $password);
        }
        require_once(ROOT . '/views/cabinet/edit.php');
        
        return true;
    }
}