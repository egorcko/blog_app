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
               <li><a href="/theme/<? echo $article['theme_id']; ?>"><?= $theme['name']; ?></a></li>
               <li><a href="#" class="icon fa-heart js-add-like liked"><? echo $article['likes']; ?></a></li>
               <li><span href="#" class="icon fa-eye"><? echo $article['watch_count']; ?></span></li>
            </ul>
         </footer>
         <? if (isset($_SESSION['user'])): ?>
            <section class="comments">
               <div class="comments__form">
                  <h2 class="comments__header">Ваш комментарий</h2>
                  <form method="POST">
                     <textarea name="comment_text" cols="30" rows="10" style="resize:none;"></textarea>
                     <button class="button comments__form_submit" type="submit" name="submit">Оставить комментарий</button>
                  </form>
               </div>
               <div class="comments__list">
                  <h2 class="comments__header">Комментарии</h2>
                  <div class="comments__list_wrapper">
                     <? if (count($comments)): ?>
                        <ul>
                           <? foreach ($comments as $comment): ?>
                              <li class="comment__item">
                                 <span class="comment__item_author"><? echo $comment['name']; ?></span>
                                 <span class="comment__item_date"><? echo date('F, d, Y G:i',strtotime($comment['date'])); ?></span>
                                 <span class="comment__item_text"><? echo $comment['text']; ?></span>
                              </li>
                           <? endforeach; ?>
                        </ul>
                     <? else: ?>
                        <h4 style="color: #aeaeae; font-weight: 500;">Нет комментариев</h4>
                     <? endif; ?>
                  </div>     
               </div>
            </section>
         <? endif; ?>
      </article>

</div>

<? include ROOT . '/views/layouts/footer.php'; ?>