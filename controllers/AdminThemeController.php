<?php

/**
* Управление темами из админки
*/
class AdminThemeController extends AdminBase {

   /**
    * Экшн для страницы управления темами
    */
   public function actionIndex() {
      self::checkAdmin();

      // Получаем список тем
      $themesList = Theme::getThemesList('admin');

      // Подключаем вид
      require_once(ROOT . '/views/admin/theme/index.php');
      return true;
   }

   /**
    * Экшн для добавления новой темы
    */
   public function actionCreate() {
      self::checkAdmin();

      // Получаем данные из формы
      if (isset($_POST['submit'])) {
         $options['name'] = $_POST['name'];
         $options['description'] = $_POST['description'];
         $options['status'] = $_POST['status'];
         
         // Добавляем новую тему
         $id = Theme::createTheme($options);

         if ($id) {
            if (is_uploaded_file($_FILES['image']['tmp_name'])) {
               move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/theme/{$id}.jpg");
            }
         }
   
         header('Location: /admin/theme');
      }
      require_once(ROOT . '/views/admin/theme/create.php');
      return true;
   }

   /**
    * Экшн для редактирования тем
    */
   public function actionUpdate($id) {
      self::checkAdmin();

      $themesList = Theme::getThemesList('admin');
      $theme = Theme::getThemeById($id);

      // Получаем данные из формы
      if (isset($_POST['submit'])) {
         $options['name'] = $_POST['name'];
         $options['description'] = $_POST['description'];
         $options['status'] = $_POST['status'];

         // Изменяем даныне темы
         if (Theme::updateTheme($id, $options)) {
            if (is_uploaded_file($_FILES['image']['tmp_name'])) {
               move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/theme/{$id}.jpg");
            }
         }
   
         header('Location: /admin/theme');
      }
      require_once(ROOT . '/views/admin/theme/update.php');
      return true;
   }

   /**
   * Экшн для страницы удаления темы
   */
   public function actionDelete($id) {
      self::checkAdmin();

      $theme = Theme::getThemeById($id);
      
      // Проверка формы
      if (isset($_POST['submit'])) {
         // Если форма отправлена - удаляем тему и перенаправляем на главную
         Theme::deleteThemeById($id);
         header('Location: /admin/theme');
      }
      // Подключаем вид
      require_once(ROOT . '/views/admin/theme/delete.php');
      return true;
   }
}