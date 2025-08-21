<div id="Layout">
  <div id="userData" class="form">
    <dl class="flex">
      <dt>Имя: </dt>
      <dd id="name"></dd>
    </dl>
    <dl class="flex">
      <dt>Фамилия: </dt>
      <dd id="surname"></dd>
    </dl>
    <dl class="flex">
      <dt>Электронная почта: </dt>
      <dd id="email"></dd>
    </dl>
    <dl class="flex">
      <dt>Сообщение: </dt>
      <dd id="message"></dd>
    </dl>
    <button id="EditUser" class="btn btn-dark align-strech">Редактировать профиль</button>
  </div>
  <div class="form">
    <h3>Ваш отзыв:</h3>
    <div id="UserReview">
      <?= $userReview ?>
    </div>
    <div id="CreateReview">
      <p id="YouHaventReview">Похоже, что вы еще не оставляли отзыв на нашем сайте. Вы можете сделать это прямо сейчас или в любое другое удобное для вас время</p>
      <?= $createReview ?>
    </div>
  </div>
</div>
<script src="JS/User/User.js"></script>
<script src="JS/User/UserFormHandler.js"></script>
<script src="JS/User/ButtonHandler.js"></script>