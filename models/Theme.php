<?php

class Theme {
   /**
    * Возвращает массив тем
    * Вызов метода с параметром 'admin' отдает все темы без ограничений
    * @param string $prop
    */
   public static function getThemesList($prop) {
      $db = Db::getConnection();

      $themesList = array();
      $sql = 'SELECT * FROM themes WHERE status = 1';

      if ($prop == 'admin') $sql = 'SELECT * FROM themes';

      $result = $db -> query($sql);
      $result -> setFetchMode(PDO::FETCH_ASSOC);

      $i=0;
      while ($row = $result -> fetch()) {
         $themesList[$i]['id'] = $row['id'];
         $themesList[$i]['name'] = $row['name'];
         $themesList[$i]['status'] = $row['status'];
         $i++;
      }
      
      return $themesList;
   }
   /**
    * Получает данные темы по заданному ID
    * @param integer $id
    * @return array
    */
    public static function getThemeById($id) {
      $db = Db::getConnection();
      $sql = 'SELECT * FROM themes WHERE id = :id';

      $result = $db -> prepare($sql);
      $result -> bindParam(':id', $id, PDO::PARAM_INT);
      $result -> execute();

      return $result -> fetch(PDO::FETCH_ASSOC);
    }
   /**
    * Получает название темы по заданному ID
    * @param integer $id
    * @return string
    */
   public static function getThemeName($id) {
      $db = Db::getConnection();
      $sql = 'SELECT name FROM themes WHERE id = :id';

      $result = $db -> prepare($sql);
      $result -> bindParam(':id', $id, PDO::PARAM_INT);
      $result -> execute();

      $name = $result -> fetch(PDO::FETCH_ASSOC);
      return $name['name'];
   }
   /**
    * Добавляет новую тему
    * @param array $options
    * @return integer ID добавленной записи
    */
    public static function createTheme($options) {
      $db = Db::getConnection();
      $sql = 'INSERT INTO themes '
            . '(name, description, status) '
            . 'VALUES '
            . '(:name, :description, :status)';

      $result = $db -> prepare($sql);
      $result -> bindParam(':name', $options['name'], PDO::PARAM_STR);
      $result -> bindParam(':description', $options['description'], PDO::PARAM_STR);
      $result -> bindParam(':status', $options['status'], PDO::PARAM_INT);

      // Если запрос прошел успешно - возвращаем последний ID, добавленный в базу
      if ($result -> execute()) return $db -> lastInsertId();
      // Иначе возвращаем 0
      return 0;
   }

   /**
    * Редактирует тему по заданному ID
    * @param integer $id 
    * @param array $options
    * @return boolean
    */
    public static function updateTheme($id, $options) {
      $db = Db::getConnection();
      $sql = 'UPDATE themes 
            SET
               name = :name,
               description = :description,
               status = :status 
            WHERE id = :id';

      // Защита от SQL инъекций, заменяем переменные из запроса самостоятельно
      $result = $db -> prepare($sql);
      $result -> bindParam(':id', $id, PDO::PARAM_INT);
      $result -> bindParam(':name', $options['name'], PDO::PARAM_STR);
      $result -> bindParam(':description', $options['description'], PDO::PARAM_STR);
      $result -> bindParam(':status', $options['status'], PDO::PARAM_INT);

      return $result -> execute();
   }

   /**
    * Удаляет тему по заданному ID
    * @param integer $id
    * @return boolean
    */
    public static function deleteThemeById($id) {
      $db = Db::getConnection();
      $sql = 'DELETE FROM themes WHERE id = :id';

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
      $path = '/upload/images/theme/';

      // Путь к изображению
      $pathToImage = $path . $id . '.jpg';

      if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToImage)) return $pathToImage;
      
      return $path . $noImage;
   }
}