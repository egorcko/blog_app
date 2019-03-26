<?php

/**
 * Главная страница в панели администратора
 */
class AdminController extends AdminBase {

    public function actionIndex() {
        // проверка доступа
        self::checkAdmin();
    
        // подключение вида
        require_once(ROOT.'/views/admin/index.php');
        return true;
    }
}