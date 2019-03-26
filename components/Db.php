<?php

class Db {
    public static function getConnection() {
        $paramsPath = ROOT.'/config/db_params.php';
        $params = include($paramsPath);

        $db = new PDO("mysql:host={$params['host']};dbname={$params['db_name']}", $params['user'], $params['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $db -> exec('set names utf8');

        return $db;
    }
}