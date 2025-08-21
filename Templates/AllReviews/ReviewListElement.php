<tr>
    <td class="table-id"><?= $id  ?></td>
    <td class="table-name"><?= $name ?></td>
    <td class="table-message"><?= $comment ?></td>
    <td class="table-button-edit text-center">
        <button class="btn btn-primary edit-review"
            data-review-id="<?= $id ?>"
            data-review-name="<?= $name ?>"
            data-review-comment="<?= $comment ?>">
            Редактировать
        </button>
    </td>
    <td class="table-button-delete text-center"><button class="btn btn-danger delete-review" data-review-id="<?= $id ?>">Удалить</button></td>
</tr>