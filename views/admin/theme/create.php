<? include ROOT . '/views/layouts/header-admin.php'; ?>

<div id="main">
   <div class="container align-center">
      <h2>Создание темы</h2>
      <form method="POST" class="login-form" enctype="multipart/form-data">
         <div class="row gtr-uniform">
            <div class="col-12 col-12-xsmall">
               <input type="text" name="name" value="" autocomplete="off" placeholder="Название*" />
            </div>
            <div class="col-12 col-12-xsmall">
               <input type="text" name="description" value="" autocomplete="off" placeholder="Описание*" />
            </div>
            <div class="col-12 col-12-xsmall">
               <label for="image" class="button icon fa-upload image-upload-wrapper">
                  Загрузить изображение
                  <input type="file" name="image" class="image-upload">
               </label>
            </div>
            <div class="col-6 col-12-small">
               <input id="status-on" type="radio" name="status" value="1" checked>
               <label for="status-on">Доступна</label>
            </div>
            <div class="col-6 col-12-small">
               <input id="status-off" type="radio" name="status" value="0">
               <label for="status-off">Недоступна</label>
            </div>
            <div class="col-12 col-12-xsmall">
               <input type="submit" class="button fit highlighted" name="submit" value="Добавить тему" />
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