<? include ROOT . '/views/layouts/header.php'; ?>

   <div id="main">
      <? if (!count($themeArticles)): ?> 
         <h2>Пока нет статей по данной теме</h2>
      <? else: ?>
         <? foreach ($themeArticles as $article): ?>
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
                     <? if (!User::isGuest()): ?>
                        <li><a href="#" class="icon fa-heart js-like <? echo User::isLiked($article['id']) ? 'js-remove-like liked' : 'js-add-like'; ?>" data-article-id="<? echo $article['id']; ?>"><? echo $article['likes']; ?></a></li>
                     <? endif; ?>
                     <li><span class="icon fa-eye"><? echo $article['watch_count']; ?></span></li>
                  </ul>
               </footer>
            </article>
         <? endforeach; ?>
      <? endif; ?>
   </div>
   <section id="sidebar">
      <section id="intro">
         <header>
            <h2><? echo $theme['name']; ?></h2>
            <p><? echo $theme['description']; ?></a></p>
            <a href="/catalog" class="button">назад</a>
         </header>
      </section>
   </section>

<? include ROOT . '/views/layouts/footer.php'; ?>