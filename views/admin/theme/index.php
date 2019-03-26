<? include ROOT . '/views/layouts/header-admin.php'; ?>

<div id="main">
   <div class="container">
      <h2>Список тем</h2>
      <div class="row">
         <? foreach ($themesList as $theme): ?>
            <div class="col-3">
               <article class="mini-post">
                  <header>
                     <h3>
                        <a class="admin-item-text" href="/theme/<? echo $theme['id']; ?>"><? echo $theme['name']; ?></a>
                        <a href="/admin/theme/update/<? echo $theme['id']; ?>" class="icon fa-pencil admin-item-icon" title="Редактировать"></a>
                        <a href="/admin/theme/delete/<? echo $theme['id']; ?>" class="icon fa-times admin-item-icon" title="Удалить"></a>
                     </h3>
                  </header>
                  <a href="/theme/<? echo $theme['id']; ?>" class="image"><img src="<? echo Theme::getImage($theme['id']); ?>" alt="" /></a>
               </article>
            </div>
         <? endforeach; ?>
         <div class="col-3">
            <article class="mini-post admin-add-new-item">
               <a href="/admin/theme/create"><i class="icon fa-plus"></i></a>
            </article>
         </div>
      </div>
   </div>
</div>

<? include ROOT . '/views/layouts/footer.php'; ?>