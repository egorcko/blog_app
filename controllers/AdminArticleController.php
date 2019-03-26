<?php

/**
* Управление статьями из админки
*/
class AdminArticleController extends AdminBase {

   /**
    * Экшн для страницы управления статьями
    */
   public function actionIndex() {
      self::checkAdmin();

      // Получаем список статей
      $articlesList = Article::getArticlesList('admin');

      // Подключаем вид
      require_once(ROOT . '/views/admin/article/index.php');
      return true;
   }

   /**
    * Экшн для добавления новой статьи
    */
   public function actionCreate() {
      self::checkAdmin();

      $themesList = Theme::getThemesList('admin');

      // Получаем данные из формы
      if (isset($_POST['submit'])) {
         $options['title'] = $_POST['title'];
         $options['description'] = $_POST['description'];
         $options['short_text'] = $_POST['short_text'];
         $options['full_text'] = $_POST['full_text'];
         $options['theme_id'] = $_POST['theme_id'];
         $options['status'] = $_POST['status'];
         
         // Добавляем новую статью
         $id = Article::createArticle($options);
   
         // Если статья добавлена проверяем добавлено ли изображение, и если да то кладем в нужную папку и даем имя
         if ($id) {
            if (is_uploaded_file($_FILES['image']['tmp_name'])) {
               move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/article/{$id}.jpg");
            }
         }
   
         header('Location: /admin/article');
      }
      require_once(ROOT . '/views/admin/article/create.php');
      return true;
   }

   /**
    * Экшн для редактирования статьи
    */
   public function actionUpdate($id) {
      self::checkAdmin();

      $themesList = Theme::getThemesList('admin');
      $article = Article::getArticleById($id);

      // Получаем данные из формы
      if (isset($_POST['submit'])) {
         $options['title'] = $_POST['title'];
         $options['description'] = $_POST['description'];
         $options['short_text'] = $_POST['short_text'];
         $options['full_text'] = $_POST['full_text'];
         $options['theme_id'] = $_POST['theme_id'];
         $options['status'] = $_POST['status'];

         if (Article::updateArticleById($id, $options)) {
            if (is_uploaded_file($_FILES['image']['tmp_name'])) {
               move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/article/{$id}.jpg");
            }
         }
   
         header('Location: /admin/article');
      }
      require_once(ROOT . '/views/admin/article/update.php');
      return true;
   }

   /**
   * Экшн для страницы удаления статьи
   */
   public function actionDelete($id) {
      self::checkAdmin();

      $article = Article::getArticleById($id);
      
      // Проверка формы
      if (isset($_POST['submit'])) {
         // Если форма отправлена - удаляем статью и перенаправляем на главную
         Article::deleteArticleById($id);
         header('Location: /admin/article');
      }
      // Подключаем вид
      require_once(ROOT . '/views/admin/article/delete.php');
      return true;
   }
}