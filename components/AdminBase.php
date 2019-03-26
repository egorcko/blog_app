<?php

/**
 * Абстрактный класс, содержит общею логику для панели администратора
 */
abstract class AdminBase {
    /**
     * Метод проверки на админа
     * Данный метод будет вызываться в каждом экшене для большей безопасности
     * @return boolean
     */
    public static function checkAdmin() {
        // Проверка авторизован ли пользователь
        $userId = User::checkLogged();

        // Получаем информацию о текущем пользователе
        $user = User::getUserById($userId);

        // Проверяем роль. Если админ - то пускаем
        if ($user['role'] == 'admin') return true;

        // Иначе завершаем работу и выводим сообщение об ошибке
        die('Access denied');
        // TODO require_once(ROOT.'/views/system/accessDenied.php')
    }
}