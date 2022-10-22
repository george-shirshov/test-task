<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/public/css/index.css">
  <title>Комментарии к фотографии</title>
</head>
<body>

  <main class="main">
    <section id="app" class="card" v-cloak>
      <h1 class="card__title" v-text="title"></h1>

      <img class="card__img" :src="image['path']" :alt="image['alt']">

      <div class="card__comments">
        <div class="card__all-comments" v-if="comments.length">
          <div class="comment" v-for="(comment, i) in comments" :key="comment['id']">
            <div class="comment__header">
              <div class="comment__user-name" v-text="comment['userName']"></div>

              <div class="comment__date" v-text="comment['date']"></div>
            </div>

            <p class="comment__text" v-text="comment['text']"></p>

            <form @submit.prevent="onDeleteCommentSubmit(i)" action="#" method="POST" name="formDeleteComment" class="comment__form-button">
              <button type="submit" name="deleteButton" class="comment__delete-button">&#10006;</button>
            </form>
          </div>
        </div>
        <p class="card__no-comments" v-else>Комментариев пока нет. Будь первым!</p>
        
        <div class="card__add-comment">
          <form @submit.prevent="onAddCommentSubmit" class="form card__form" action="#" method="POST">
            <div class="form__item">
              <label class="form__label" for="formUserName">Имя*:</label>
              <input v-model.trim="formAddComment['userName']" id="formUserName" class="form__input" type="text" placeholder="Иван" tabindex="1">
              <p class="error-message" v-if="errors['userName']">
                Заполните данное поле
              </p>
            </div>
            
            <div class="form__item">
              <label class="form__label" for="formMessage">Сообщение*:</label>
              <textarea v-model.trim="formAddComment['text']" id="formMessage" class="form__input" tabindex="2"></textarea>
              <p class="error-message" v-if="errors['text']">
                Заполните данное поле
              </p>
            </div>
            
            <div class="form__item">
              <div class="checkbox">
                <input type="checkbox" v-model="formAddComment['сaptcha']" class="checkbox__input" id="formCaptcha" tabindex="3">
                <label class="form__label checkbox__label" for="formCaptcha">Я не робот*</label>
              </div>
              <p class="error-message" v-if="errors['сaptcha']">
                Заполните данное поле
              </p>
            </div>

            <button type="submit" class="form__button" tabindex="4">Добавить комментарий</button>
          </form>
          
        </div>             
      </div>
    </section>
  </main>

  <script src="https://unpkg.com/vue@next"></script>
  <script src="/public/js/app.js"></script>
</body>
</html>