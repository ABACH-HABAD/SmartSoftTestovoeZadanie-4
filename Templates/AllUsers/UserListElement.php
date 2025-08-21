<tr>
    <td class="table-id"><?= $id  ?></td>
    <td class="table-name"><?= $name ?></td>
    <td class="table-surname"><?= $surname ?></td>
    <td class="table-email"><?= $email ?></td>
    <td class="table-message"><?= $message ?></td>
    <td class="table-button-edit text-center">
        <button class="btn btn-primary  edit-account"
            data-account-id="<?= $id ?>"
            data-account-name="<?= $name ?>"
            data-account-surname="<?= $surname ?>"
            data-account-email="<?= $email ?>"
            data-account-message="<?= $message ?>">
            Редактировать
        </button>
    </td>
    <td class="table-button-delete text-center">
        <button class="btn btn-danger  delete-account" data-account-id="<?= $id ?>">Удалить</button>
    </td>
</tr>