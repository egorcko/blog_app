<? include ROOT . '/views/layouts/header.php'; ?>

   <div id="main">
      <? foreach ($articles as $article): ?>
         <article class="post">
            <header>
               <div class="title">
                  <h2><a href="/article/<? echo $article['id']; ?>"><? echo $article['title']; ?></a></h2>
                  <p><? echo $article['description']; ?></p>
               </div>
               <div class="meta">
                  <time class="published" datetime="<? echo $article['date']; ?>"><? echo date('F, d, Y',strtotime($article['date'])); ?></time>
               </div>
            </header>
            <a href="/article/<? echo $article['id']; ?>" class="image featured"><img src="./../../template/images/pic01.jpg" alt="" /></a>
            <? echo $article['short_text']; ?>
            <footer>
               <ul class="actions">
                  <li><a href="/article/<? echo $article['id']; ?>" class="button large">Продолжить чтение</a></li>
               </ul>
               <ul class="stats">
                  <li><a href="/theme/<? echo $article['theme_id']; ?>"><? echo Theme::getThemeName($article['theme_id']); ?></a></li>
                  <? if (!User::isGuest()): ?>
                     <li><a href="#" class="icon fa-heart js-like <? echo User::isLiked($article['id']) ? 'js-remove-like liked' : 'js-add-like'; ?>" data-article-id="<? echo $article['id']; ?>"><? echo $article['likes']; ?></a></li>
                  <? endif; ?>
                  <li><span class="icon fa-eye"><? echo $article['watch_count']; ?></span></li>
               </ul>
            </footer>
         </article>
      <? endforeach; ?>
   </div>
   <? include ROOT . '/views/layouts/aside.php'; ?>

<? include ROOT . '/views/layouts/footer.php'; ?>

<!-- <? echo Article::getArticleImage($article['id']); ?> -->