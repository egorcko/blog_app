<? include ROOT . '/views/layouts/header.php'; ?>

<div id="main">
   <div class="container align-center">
      <h2>Регистрация на сайте</h2>
      <form method="post" class="login-form">
         <div class="row gtr-uniform">
            <div class="col-12 col-12-xsmall">
               <input type="text" name="name" value="" autocomplete="off" placeholder="Имя*" />
            </div>
            <div class="col-12 col-12-xsmall">
               <input type="email" name="email" value="" autocomplete="off" placeholder="Email*" />
            </div>
            <div class="col-12 col-12-xsmall">
               <input type="password" name="password" autocomplete="off" placeholder="Пароль*" />
            </div>
            <div class="col-12 col-12-xsmall">
               <input type="submit" class="button fit highlighted" name="submit" value="Регистрация" />
            </div>
            <div class="col-12 col-12-xsmall">
               <a onclick="history.back();" class="button fit">Назад</a>
            </div>
         </div>
      </form>
      <span>* Обязательное поле</span>
   </div>
</div>

<? include ROOT . '/views/layouts/footer.php'; ?>