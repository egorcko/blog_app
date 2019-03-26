<?php

class Article {
   /**
    * Получает список постов
    * Вызов метода с параметром 'admin' отдает все темы без ограничений
    * @param string $prop
    * @return array
    */
   public static function getArticlesList($prop) {
      $db = Db::getConnection();
      $sql = "SELECT * FROM articles ".
            "WHERE status = 1 ".
            "ORDER BY date DESC";

      if ($prop == 'admin') $sql = 'SELECT * FROM articles ORDER BY date DESC';

      $result = $db -> query($sql);
      $result -> setFetchMode(PDO::FETCH_ASSOC);

      $i=0;
      while ($row = $result -> fetch()) {
         $articles[$i]['id'] = $row['id'];
         $articles[$i]['title'] = $row['title'];
         $articles[$i]['description'] = $row['description'];
         $articles[$i]['short_text'] = $row['short_text'];
         $articles[$i]['full_text'] = $row['full_text'];
         $articles[$i]['theme_id'] = $row['theme_id'];
         $articles[$i]['likes'] = $row['likes'];
         $articles[$i]['watch_count'] = $row['watch_count'];
         $articles[$i]['date'] = $row['date'];
         $articles[$i]['status'] = $row['status'];
         $i ++;
      } 
      return $articles;
   }
   /**
    * Получает список постов для заданной темы
    * @param integer $themeId
    * @return array
    */
   public static function getArticlesListByTheme($themeId = false) {
      if ($themeId) {

         $db = Db::getConnection();
         $articles = array();
         $result = $db -> query('SELECT * FROM articles '
               . "WHERE status = '1' AND theme_id = {$themeId} "
               . 'ORDER BY date DESC');

         while ($row = $result -> fetch()) {
               $articles[] = $row;
         } 

         return $articles;
      }
   }
   /**
    * Получает количество постов в заданной теме
    * @param integer $themeId
    * @return integer
    */
   public static function getArticlesCountByTheme($themeId) {
      $db = Db::getConnection();
      $sql = "SELECT COUNT(*) FROM articles WHERE theme_id = :theme_id";

      $result = $db -> prepare($sql);
      $result -> bindParam(':theme_id', $themeId, PDO::PARAM_INT);
      $result -> execute();

      $count = $result -> fetch(PDO::FETCH_ASSOC);
      return $count['COUNT(*)'];
   }
   /**
    * Получает пост по заданному ID
    * @param integer $id
    * @return array
    */
   public static function getArticleById($id) {
      if ($id) {
         $db = Db::getConnection();
         $sql = "SELECT * FROM articles WHERE id = :id";

         $result = $db -> prepare($sql);
         $result -> bindParam(':id', $id, PDO::PARAM_INT);

         $result -> setFetchMode(PDO::FETCH_ASSOC);
         $result -> execute();

         return $result -> fetch();
      }
   }

   /**
    * Добавляет новую статью
    * @param array $options
    * @return integer ID добавленной записи
    */
    public static function createArticle($options) {
      $db = Db::getConnection();
      $sql = 'INSERT INTO articles '
            . '(title, description, short_text, full_text, theme_id, status) '
            . 'VALUES '
            . '(:title, :description, :short_text, :full_text, :theme_id, :status)';

      $result = $db -> prepare($sql);
      $result -> bindParam(':title', $options['title'], PDO::PARAM_STR);
      $result -> bindParam(':description', $options['description'], PDO::PARAM_STR);
      $result -> bindParam(':short_text', $options['short_text'], PDO::PARAM_STR);
      $result -> bindParam(':full_text', $options['full_text'], PDO::PARAM_STR);
      $result -> bindParam(':theme_id', $options['theme_id'], PDO::PARAM_INT);
      $result -> bindParam(':status', $options['status'], PDO::PARAM_INT);

      // Если запрос прошел успешно - возвращаем последний ID добавленный в базу
      if ($result -> execute()) return $db -> lastInsertId();
      // Иначе возвращаем 0
      return 0;
   }

   /**
    * Редактирует статью по заданному ID
    * @param integer $id 
    * @param array $options
    * @return boolean
    */
    public static function updateArticleById($id, $options) {
      $db = Db::getConnection();
      $sql = 'UPDATE articles 
            SET
               title = :title,
               description = :description,
               short_text = :short_text,
               full_text = :full_text,
               theme_id = :theme_id,
               status = :status
            WHERE id = :id';

      // Защита от SQL инъекций, заменяем переменные из запроса самостоятельно
      $result = $db -> prepare($sql);
      $result -> bindParam(':id', $id, PDO::PARAM_INT);
      $result -> bindParam(':title', $options['title'], PDO::PARAM_STR);
      $result -> bindParam(':description', $options['description'], PDO::PARAM_STR);
      $result -> bindParam(':short_text', $options['short_text'], PDO::PARAM_STR);
      $result -> bindParam(':full_text', $options['full_text'], PDO::PARAM_STR);
      $result -> bindParam(':theme_id', $options['theme_id'], PDO::PARAM_INT);
      $result -> bindParam(':status', $options['status'], PDO::PARAM_INT);

      return $result -> execute();
   }

   /**
   * Удаляет статью по заданному ID
   * @param integer $id
   * @return boolean
   */
   public static function deleteArticleById($id) {
      $db = Db::getConnection();
      $sql = 'DELETE FROM articles WHERE id = :id';

      // Защита от SQL инъекций, заменяем переменные из запроса самостоятельно
      $result = $db -> prepare($sql);
      $result -> bindParam(':id', $id, PDO::PARAM_INT);

      return $result -> execute();
   }

   /**
    * Возвращает путь к изображению
    * @param integer $id
    * @return string
    */
    public static function getImage($id) {
      // Название изображения-пустышки
      $noImage = 'no-image.jpg';

      // Путь к папке с товарами
      $path = '/upload/images/article/';

      // Путь к изображению
      $pathToImage = $path . $id . '.jpg';

      if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToImage)) return $pathToImage;
      
      return $path . $noImage;
   }
   /**
    * Увеличивает счетчик просмотров статьи по заданному ID
    * @param integer $id
    */
   public static function increaseWatchCount($id) {
      if ($id) {
         $db = Db::getConnection();
         $sql = "UPDATE articles SET watch_count = watch_count + 1 WHERE id = :id";

         $result = $db -> prepare($sql);
         $result -> bindParam(':id', $id, PDO::PARAM_INT);

         return $result -> execute();
      }
   }
   /**
    * Увеличивает счетчик лайков
    * @param integer $id
    */
   public static function addLike($id) {
      if ($id) {
         $db = Db::getConnection();
         $sql = "UPDATE articles SET likes = likes + 1 WHERE id = :id";

         $result = $db -> prepare($sql);
         $result -> bindParam(':id', $id, PDO::PARAM_INT);

         return $result -> execute();
      }
   }
   /**
    * Уменьшает счетчик лайков
    * @param integer $id
    */
   public static function removeLike($id) {
      if ($id) {
         $db = Db::getConnection();
         $sql = "UPDATE articles SET likes = likes - 1 WHERE id = :id";

         $result = $db -> prepare($sql);
         $result -> bindParam(':id', $id, PDO::PARAM_INT);

         return $result -> execute();
      }
   }
}