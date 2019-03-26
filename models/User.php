<?php

class User {

    public static function register($name, $email, $password) {
        $db = Db::getConnection();
        $sql = 'INSERT INTO users (name, email, password) '
                . 'VALUES (:name, :email, :password)';

        $result = $db -> prepare($sql);
        $result -> bindParam(':name', $name, PDO::PARAM_STR);
        $result -> bindParam(':email', $email, PDO::PARAM_STR);
        $result -> bindParam(':password', $password, PDO::PARAM_STR);

        return $result -> execute();
    }

    public static function checkUserData($email, $password) {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM users WHERE email = :email AND password = :password';

        $result = $db -> prepare($sql);
        $result -> bindParam(':email', $email, PDO::PARAM_STR);
        $result -> bindParam(':password', $password, PDO::PARAM_STR);
        $result -> execute();

        $user = $result -> fetch();
        if ($user) return $user['id'];

        return false;
    }

    public static function getUserById($id) {
        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM users WHERE id = :id';

            $result = $db -> prepare($sql);
            $result -> bindParam(':id', $id, PDO::PARAM_INT);

            $result -> setFetchMode(PDO::FETCH_ASSOC);
            $result -> execute();

            return $result -> fetch();
        }
    }

    public static function edit($id, $name, $email, $password) {
        $db = Db::getConnection();
        $sql = 'UPDATE users 
                SET name = :name, password = :password, email = :email
                WHERE id = :id';
                
        $result = $db -> prepare($sql);
        $result -> bindParam(':id', $id, PDO::PARAM_INT);
        $result -> bindParam(':name', $name, PDO::PARAM_STR);
        $result -> bindParam(':email', $email, PDO::PARAM_STR);
        $result -> bindParam(':password', $password, PDO::PARAM_STR);
        return $result -> execute();
    }

    public static function auth($userId) {
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged() {
        if (isset($_SESSION['user'])) return $_SESSION['user'];

        header('Location: /user/login');
    }

    public static function isGuest() {
        if (isset($_SESSION['user'])) return false;
        
        return true;
    }

    public static function isAdmin() {
        if (isset($_SESSION['user'])) $user = self::getUserById($_SESSION['user']);

        if ($user['role'] == 'admin') return true;
        
        return false;
    }
    
    public static function getLikedPosts() {
        $userId = $_SESSION['user'];
        $db = Db::getConnection();
        $sql = "SELECT article_id FROM liked_post WHERE user_id = :user_id";

        $result = $db -> prepare($sql);
        $result -> bindParam(':user_id', $userId, PDO::PARAM_INT);

        $result -> setFetchMode(PDO::FETCH_ASSOC);
        $result -> execute();

        return $result -> fetchAll();
    }

    /**
     * Проверяет лайкал ли пользователь данный пост
     * @param integer $articleId
     * @return boolean
     */
    public static function isLiked($articleId) {
        $likedList = (array) self::getLikedPosts();

        foreach ($likedList as $item) {
            if ($item['article_id'] == $articleId) return true;
        }
        return false;
    }

    public static function setLikedPost($articleId) {
        $likedList = self::getLikedPosts();
        $db = Db::getConnection();
        $sql = false;

        foreach ($likedList as $item) {
            if ($item['article_id'] == $articleId) {
                $sql = 'DELETE FROM liked_post WHERE article_id = :article_id AND user_id = :user_id';
            }
        }
        if (!$sql) {
            $sql = 'INSERT INTO liked_post (user_id, article_id) '.
                    'VALUES (:user_id, :article_id)';
        }
        $result = $db -> prepare($sql);
        $result -> bindParam(':user_id', $_SESSION['user'], PDO::PARAM_INT);
        $result -> bindParam(':article_id', $articleId, PDO::PARAM_INT);

        return $result -> execute();
    }
}