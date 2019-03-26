<? include ROOT . '/views/layouts/header.php'; ?>

<div id="main">

   <!-- Post -->
      <article class="post">
         <header>
            <div class="title">
               <h2><? echo $article['title']; ?></h2>
               <p><? echo $article['description']; ?></p>
            </div>
            <div class="meta">
               <time class="published" datetime="<? echo $article['date']; ?>"><? echo date('F, d, Y',strtotime($article['date'])); ?></time>
            </div>
         </header>
         <span class="image featured"><img src="./../../template/images/pic01.jpg" alt="" /></span>
         <? echo $article['full_text']; ?>
         <footer>
            <ul class="stats">
               <li><a href="/theme/<? echo $article['theme_id']; ?>">General</a></li>
               <li><a href="#" class="icon fa-heart js-add-like liked"><? echo $article['likes']; ?></a></li>
               <li><span href="#" class="icon fa-eye"><? echo $article['watch_count']; ?></span></li>
            </ul>
         </footer>
      </article>

</div>

<? include ROOT . '/views/layouts/footer.php'; ?>