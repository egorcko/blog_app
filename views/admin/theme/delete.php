<? include ROOT . '/views/layouts/header-admin.php'; ?>

<div id="main">
   <div class="container align-center">
      <h2>Вы действительно хотите удалить тему <? echo $theme['name']; ?>?</h2>
      <form method="POST">
         <div class="row">
            <div class="col-6">
               <input type="submit" name="submit" class="button fit highlighted" value="Удалить"/>
            </div>
            <div class="col-6">
               <a href="/admin/theme" class="button fit">Отменить</a>
            </div>
         </div>
      </form>
   </div>
</div>

<? include ROOT . '/views/layouts/footer.php'; ?>