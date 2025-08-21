$(document).ready(function () {
  $(document).on("click", ".delete-review", deletReview);
  $(document).on("click", ".edit-review", editReview);
});

async function deletReview() {
  const reviewId = $(this).data("review-id");
  const row = $(this).closest("tr");

  await Swal.fire({
    title: "Подтвержидение",
    text: "Вы уверены что хотите удалить отзыв?",
    icon: "question",
    showDenyButton: true,
    confirmButtonText: "Да, хочу удалить",
    denyButtonText: "Нет, ненадо",
  }).then((result) => {
    if (result.isDenied) {
      Swal.fire({
        title: "Отмена",
        text: "Отзыв не был удалён",
      });
      throw "Отзыв не был удалён";
    }
  });

  $.ajax({
    url: "API/Delete_review.php",
    type: "POST",
    contentType: "application/json",
    data: JSON.stringify({ id: reviewId }),
    success: function (response) {
      if (response.success) {
        Swal.fire({
          title: "Успех!",
          text: "Отзыв успешно удалён",
          icon: "success",
        });
        row.fadeOut(300, function () {
          $(this).remove();
        });
      } else {
        Swal.fire({
          title: "Ошибка!",
          text: "Произошла ошибка при удалении: " + response.error,
          icon: "error",
        });
      }
    },
    error: function (response, xhr, status, error) {
      var errText =
        "Произошла критическая ошибка при удалении! Повторите попытку отправить позже.";
      if (
        response.responseJSON != null &&
        response.responseJSON != undefined &&
        response.responseJSON.error != undefined &&
        response.responseJSON.error != null
      )
        errText = response.responseJSON.error;
      Swal.fire({
        title: "Критическая ошибка!",
        text: errText,
        icon: "error",
      });
    },
  });
}

function editReview() {
  const reviewName = $(this).data("review-name");
  const reviewId = $(this).data("review-id");
  const reviewComment = $(this).data("review-comment");

  const Label = document.getElementById("InputName3_label");
  const InputName = document.getElementById("InputName3");

  $("#InputName3").prop("disabled", true);

  const Form = document.getElementById("FormCreateReview");

  Form.reset();
  if (
    Form.style.visibility == "hidden" ||
    (Form.style.visibility == "visible" &&
      reviewId != document.getElementById("InputName3")) ||
    (Form.style.visibility == "visible" &&
      document.getElementById("editReviewTitle").textContent ==
        "Создание нового отзыва")
  ) {
    Form.style.visibility = "visible";
    Form.style.display = "block";
    document.getElementById("editReviewTitle").textContent =
      "Редактирование отзыва";

    InputName.placeholder = "Введите имя";
    Label.textContent = "Имя пользователя";

    document.getElementById("InputName3").value = reviewName;
    document.getElementById("InputMessageCreateReview").textContent =
      reviewComment;
  } else {
    Form.style.visibility = "hidden";
    Form.style.display = "none";
  }
}
