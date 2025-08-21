<div class="form">
    <h2 class="headline">Список всех отзывов</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-users" id="usersData">
            <colgroup>
                <col class="table-id">
                <col class="table-name">
                <col class="table-message">
                <col class="table-button-edit text-center">
                <col class="table-button-delet text-center">
            </colgroup>
            <tr>
                <th class="table-id">Id</th>
                <th class="table-name">Имя</th>
                <th class="table-message">Отзыв</th>
                <th class="table-button-edit text-center">Редактировать</th>
                <th class="table-button-delet text-center">Удалить</th>
            </tr>
            <?php
            for ($i = 0; $i < count($reviews); $i++) {
                echo $reviews[$i];
            }
            ?>
        </table>
    </div>
    <?= $reviewForm ?>
</div>
<script src="JS/AllReviews/AllReviewsFormHandler.js"></script>
<script src="JS/AllReviews/AllReviewsTable.js"></script>