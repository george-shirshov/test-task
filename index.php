<?php
  require_once __DIR__ . '/db/db-mysql.php';

  use db\DbMySql;

  $db = new DbMySql();
?>

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
    <section class="card">
      <h1 class="card__title">
        Рыжий кот
      </h1>

      <img class="card__img" src="/public/img/orange-cat.jpg" alt="Рыжий кот">

      <div class="card__comments">
        <div class="card__all-comments">
          <?php
            $comments = $db->getAllComments();
            if (count($comments)) {
              foreach($comments as $comment){           
          ?>               
                <div class="comment">
                  <div class="comment__header">
                    <div class="comment__user-name">
                      <?= $comment[1] ?>
                    </div>
                    <div class="comment__date">
                      <?= $comment[2] ?>
                    </div>
                  </div>
      
                  <p class="comment__text">
                      <?= $comment[3] ?>
                  </p>
      
                  <form action="#" method="POST" name="formDeleteComment" class="comment__form-button">
                    <button type="submit" value="<?= $comment[0] ?>" name="deleteButton" class="comment__delete-button">&#10006;</button>
                  </form>
                </div>      
          <?php }
            }else{
              echo '
                <p class="card__no-comments">
                  Комментариев нет
                </p>';     
            }
          ?>
        </div>
        
        <div class="card__add-comment">
          <form id="formAddComment" class="form card__form" action="#" method="POST">
            <div class="form__item">
              <label class="form__label" for="formUserName">Имя*:</label>
              <input id="formUserName" class="form__input req" type="text" name="userName" placeholder="Иван" tabindex="1">
              <p name="errorMessage" class="no-error">
                Заполните данное поле
              </p>
            </div>
            
            <div class="form__item">
              <label class="form__label" for="formMessage">Сообщение*:</label>
              <textarea id="formMessage" class="form__input req" name="message" tabindex="2"></textarea>
              <p name="errorMessage" class="no-error">
                Заполните данное поле
              </p>
            </div>
            
            <div class="form__item">
              <input class="form__captcha req" type="checkbox" name="captcha" id="formCaptcha" tabindex="3">
              <label class="form__label" for="formCaptcha">Я не робот*:</label>
              <p name="errorMessage" class="no-error">
                Заполните данное поле
              </p>
            </div>

            <button type="submit" class="form__button" tabindex="4">Добавить комментарий</button>
          </form>
          
        </div>
               
      </div>
    </section>
  </main>

  <script src="/public/js/index.js"></script>
</body>
</html>