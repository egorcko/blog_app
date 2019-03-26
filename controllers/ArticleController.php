<?php

class ArticleController {
   /**
    * Экшн для просмотра одного поста
    */
   public function actionView($articleId) {
      Article::increaseWatchCount($articleId);
      $article = Article::getArticleById($articleId);

      require_once(ROOT.'/views/article/view.php');

      return true;
   }
   /**
    * Поставить/убрать лайк
    */
   public function actionAddLike($articleId) {
      User::setLikedPost($articleId);
      Article::addLike($articleId);

      return true;
   }
   public function actionRemoveLike($articleId) {
      User::setLikedPost($articleId);
      Article::removeLike($articleId);

      return true;
   }
}