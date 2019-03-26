<? include ROOT . '/views/layouts/header.php'; ?>

<div id="main">
   <div class="container align-center">
      <h2>Профиль пользователя</h2>
      <? if ($result): ?>
         <br>
         <h4>Данные отредактированы!</h4>
         <a href="/" class="button">На главную</a>
      <? else: ?>
         <form method="post" class="login-form">
            <div class="row gtr-uniform">
               <div class="col-12 col-12-xsmall">
                  <input type="text" name="name" autocomplete="off" value="<? echo $name; ?>" placeholder="Имя" />
               </div>
               <div class="col-12 col-12-xsmall">
                  <input type="email" name="email" autocomplete="off" value="<? echo $email; ?>" placeholder="Email" />
               </div>
               <div class="col-12 col-12-xsmall">
                  <input type="password" name="password" autocomplete="off" value="<? echo $password; ?>" placeholder="Пароль" />
               </div>
               <div class="col-12 col-12-xsmall">
                  <input type="submit" class="button fit highlighted" name="submit" value="Изменить данные" />
               </div>
               <div class="col-12 col-12-xsmall">
                  <a onclick="history.back();" class="button fit">Назад</a>
               </div>
            </div>
         </form>
      <? endif; ?>
   </div>
</div>

<? include ROOT . '/views/layouts/footer.php'; ?>