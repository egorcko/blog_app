<? include ROOT . '/views/layouts/header-admin.php'; ?>

<div id="main">
   <div class="container">
      <h2>Список статей</h2>
      <div class="row">
         <? foreach ($articlesList as $article): ?>
            <div class="col-3">
               <article class="mini-post">
                  <header>
                     <span class="published theme-name"><? echo Theme::getThemeName($article['theme_id']); ?></span>
                     <h3>
                        <a class="admin-item-text" href="/article/<? echo $article['id']; ?>"><? echo $article['title']; ?></a>
                        <a href="/admin/article/update/<? echo $article['id']; ?>" class="icon fa-pencil admin-item-icon" title="Редактировать"></a>
                        <a href="/admin/article/delete/<? echo $article['id']; ?>" class="icon fa-times admin-item-icon" title="Удалить"></a>
                     </h3>
                  </header>
                  <a href="/article/<? echo $article['id']; ?>" class="image"><img src="<? echo Article::getImage($article['id']); ?>" alt="" /></a>
               </article>
            </div>
         <? endforeach; ?>
         <div class="col-3">
            <article class="mini-post admin-add-new-item">
               <a href="/admin/article/create"><i class="icon fa-plus"></i></a>
            </article>
         </div>
      </div>
   </div>
</div>

<? include ROOT . '/views/layouts/footer.php'; ?>