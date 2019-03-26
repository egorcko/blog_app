<?php

class SiteController {
    public function actionIndex() {

        $articles = Article::getArticlesList('default');
        
        require_once(ROOT.'/views/site/index.php');

        return true;
    }
}