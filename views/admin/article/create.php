<? include ROOT . '/views/layouts/header-admin.php'; ?>

<div id="main">
   <div class="container align-center">
      <h2>Создание статьи</h2>
      <form method="POST" class="login-form" enctype="multipart/form-data">
         <div class="row gtr-uniform">
            <div class="col-12 col-12-xsmall">
               <input type="text" name="title" value="" autocomplete="off" placeholder="Название*" />
            </div>
            <div class="col-12 col-12-xsmall">
               <input type="text" name="description" value="" autocomplete="off" placeholder="Описание*" />
            </div>
            <div class="col-12">
               <select name="theme_id">
                  <option value="">- Тема -</option>
                  <? foreach ($themesList as $theme): ?>
                     <option value="<? echo $theme['id']; ?>"><? echo $theme['name']; ?></option>
                  <? endforeach; ?>
               </select>
            </div>
            <div class="col-12">
               <div class="text-buttons-row">
                  <span class="button small js-add-tag" data-start-tag="&lt;h4&gt;" data-end-tag="&lt;/h4&gt;">заголовок</span>
                  <span class="button small js-add-tag" data-start-tag="&lt;p&gt;" data-end-tag="&lt;/p&gt;">абзац</span>
                  <span class="button small js-add-tag" data-start-tag="&lt;blockquote&gt;" data-end-tag="&lt;/blockquote&gt;">цитата</span>
                  <span class="button small js-add-tag" data-start-tag="&lt;strong&gt;" data-end-tag="&lt;/strong&gt;">жирный</span>
                  <span class="button small js-add-tag" data-start-tag="&lt;i&gt;" data-end-tag="&lt;/i&gt;">курсив</span>
                  <span class="button small js-add-tag" data-start-tag="&lt;u&gt;" data-end-tag="&lt;/u&gt;">подчеркнутый</span>
               </div>
               <textarea class="js-textarea" name="short_text" cols="30" rows="3" placeholder="Часть текста*"></textarea>
            </div>
            <div class="col-12">
               <div class="text-buttons-row">
                  <span class="button small js-add-tag" data-start-tag="&lt;h3&gt;" data-end-tag="&lt;/h3&gt;">заголовок</span>
                  <span class="button small js-add-tag" data-start-tag="&lt;p&gt;" data-end-tag="&lt;/p&gt;">абзац</span>
                  <span class="button small js-add-tag" data-start-tag="&lt;blockquote&gt;" data-end-tag="&lt;/blockquote&gt;">цитата</span>
                  <span class="button small js-add-tag" data-start-tag="&lt;strong&gt;" data-end-tag="&lt;/strong&gt;">жирный</span>
                  <span class="button small js-add-tag" data-start-tag="&lt;i&gt;" data-end-tag="&lt;/i&gt;">курсив</span>
                  <span class="button small js-add-tag" data-start-tag="&lt;u&gt;" data-end-tag="&lt;/u&gt;">подчеркнутый</span>
               </div>
               <textarea class="js-textarea" name="full_text" cols="30" rows="10" placeholder="Полный текст*"></textarea>
            </div>
            <div class="col-12"></div>
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
               <input type="submit" class="button fit highlighted" name="submit" value="Добавить статью" />
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