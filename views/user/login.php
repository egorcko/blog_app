<? include ROOT . '/views/layouts/header.php'; ?>

<div id="main">
   <div class="container align-center">
      <h2>Вход на сайт</h2>
      <form method="post" class="login-form">
         <div class="row gtr-uniform">
            <div class="col-12 col-12-xsmall">
               <input type="email" name="email" value="" placeholder="Email*" />
            </div>
            <div class="col-12 col-12-xsmall">
               <input type="password" name="password" placeholder="Пароль" />
            </div>
            <? if ($errors): ?>
               <span class="login-error"><? echo $errors[0]; ?></span>
            <? endif; ?>
            <div class="col-12 col-12-xsmall">
               <input type="submit" class="button fit highlighted" name="submit" value="Вход" />
            </div>
            <div class="col-12 col-12-xsmall">
               <a onclick="history.back();" class="button fit">Назад</a>
            </div>
         </div>
      </form>
   </div>
</div>

<? include ROOT . '/views/layouts/footer.php'; ?>