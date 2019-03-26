<? include ROOT . '/views/layouts/header.php'; ?>

<div id="main">
   <div class="container">
      <h2>Список тем</h2>
      <div class="row">
         <? foreach ($themes as $theme): ?>
            <div class="col-3">
               <article class="mini-post">
                  <header>
                     <h3><a href="/theme/<? echo $theme['id']; ?>"><? echo $theme['name']; ?></a></h3>
                     <span class="posts-count">Количество статей: <strong><? echo Article::getArticlesCountByTheme($theme['id']); ?></strong></span>
                  </header>
                  <a href="/theme/<? echo $theme['id']; ?>" class="image"><img src="<? echo Theme::getImage($theme['id']); ?>" alt="" /></a>
               </article>
            </div>
         <? endforeach; ?>
      </div>
   </div>
</div>

<? include ROOT . '/views/layouts/footer.php'; ?>