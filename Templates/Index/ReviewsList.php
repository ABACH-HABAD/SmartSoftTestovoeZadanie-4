<div class="reviews-block">
    <div class="form-group margin-down mx-4">
        <h2 class="from-headline" id="FromHeadline">Отзвывы</h2>
        <div class="form-text from-subheadline">
            Популярные отзывы наших клиентов😊
        </div>
    </div>
    <div id="ReviewList" class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
        <?php
        for ($i = 0; $i < count($reviews); $i++) {
            echo $reviews[$i];
        }
        ?>
    </div>
    <?= $formCreateReview; ?>
</div>