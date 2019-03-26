<?php

class CatalogController {

    public function actionIndex() {
        $themes = array();
        $themes = Theme::getThemesList('site');

        require_once(ROOT.'/views/catalog/index.php');

        return true;
    }

    public function actionTheme($themeId) {
        $theme = array();
        $theme = Theme::getThemeById($themeId);
        
        $themeArticles = array();
        $themeArticles = Article::getArticlesListByTheme($themeId);

        require_once(ROOT.'/views/catalog/theme.php');

        return true;
    }
}