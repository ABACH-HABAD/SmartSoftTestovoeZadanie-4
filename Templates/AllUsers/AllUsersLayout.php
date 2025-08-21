<div class="form">
    <h2 class="headline">Список всех зарегестрированных пользователей</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-users" id="usersData">
            <colgroup>
                <col class="table-id">
                <col class="table-name">
                <col class="table-surname">
                <col class="table-email">
                <col class="table-message">
                <col class="table-button-edit">
                <col class="table-button-delete">
            </colgroup>
            <tr>
                <th class="table-id">Id</th>
                <th class="table-name">Имя</th>
                <th class="table-surname">Фамилия</th>
                <th class="table-email">Почта</th>
                <th class="table-message">Сообщение</th>
                <th class="table-button-edit text-center">Редактировать</th>
                <th class="table-button-delete text-center">Удалить</th>
            </tr>
            <?php
            for ($i = 0; $i < count($users); $i++) {
                echo $users[$i];
            }
            ?>
        </table>
    </div>
    <button id="addAccount" class="btn btn-dark align-strech">Добавить пользователя</button>
    <?= $userForm ?>
</div>
<script src="JS/AllUsers/AllUsersFormHandler.js"></script>
<script src="JS/AllUsers/AllUsersTable.js"></script>