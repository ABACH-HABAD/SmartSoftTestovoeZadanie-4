document.addEventListener("DOMContentLoaded", function () {
  const Form = document.getElementById("FormCreateReview");

  Form.style.marginBottom = 0;
  Form.style.visibility = "hidden";
  Form.style.display = "none";
});

$(document).ready(function () {
  $("#FormCreateReview").on("submit", sendForm);
  $(document).on("click", "#AddReview", function () {
    const Form = document.getElementById("FormCreateReview");
    const InputName = document.getElementById("InputName3");
    Form.reset();
    $("#InputMessageCreateReview").val("");
    if (
      Form.style.visibility == "hidden" ||
      (Form.style.visibility == "visible" &&
        document.getElementById("editReviewTitle").textContent ==
          "Редактирование отзыва")
    ) {
      Form.style.visibility = "visible";
      Form.style.display = "block";
      $("#editReviewTitle").text("Создание нового отзыва");
      $("#InputName3").prop("disabled", false);

      InputName.placeholder =
        "Введите ID пользователя, от имени которого хотите оставить отзыв";
      $("#InputName3_label").text("ID пользователя");
    } else {
      Form.style.visibility = "hidden";
      Form.style.display = "none";
    }
  });
});

function sendForm(event) {
  event.preventDefault();

  var exMessage = "";

  if (
    document.getElementById("editReviewTitle").textContent ==
    "Создание нового отзыва"
  ) {
    if ($("#InputName3").val().length < 1) {
      exMessage +=
        "Введите ID пользователя, от имени которого хотите оставить отзыв<br>";
    }

    if (
      isNaN(parseFloat($("#InputName3").val())) ||
      !isFinite($("#InputName3").val())
    ) {
      exMessage +=
        "В поле 'Имя' ведите ID пользователя, от имени которого хотите оставить отзыв<br>";
    }
  } else {
    if ($("#InputName3").val().length < 1) {
      exMessage +=
        "Введите имя пользователя, от имени которого хотите оставить отзыв<br>";
    }
  }

  if ($("#InputMessageCreateReview").val().length < 1) {
    exMessage += "Введите сообщение<br>";
  }

  if (exMessage) {
    Swal.fire("Неверные данные", exMessage, "error");
    return;
  }

  var formData = {
    id: $("#InputName3").val(),
    comment: $("#InputMessageCreateReview").val(),
  };

  if (
    document.getElementById("editReviewTitle").textContent ==
    "Редактирование отзыва"
  ) {
    $.ajax({
      url: "API/Edit_review.php",
      type: "POST",
      contentType: "application/json",
      data: JSON.stringify(formData),
      success: function (response) {
        if (response.success) {
          Swal.fire({
            title: "Успех!",
            text: "Отзыв успешно обновлён",
            icon: "success",
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload();
            }
          });
        } else {
          Swal.fire({
            title: "Ошибка!",
            text: "Произошла ошибка при отправке: " + response.error,
            icon: "error",
          });
        }
      },
      error: function (response, xhr, status, error) {
        var errText =
          "Произошла критическая ошибка при отправке! Повторите попытку отправить позже.";
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
  } else {
    $.ajax({
      url: "API/Add_review.php",
      type: "POST",
      contentType: "application/json",
      data: JSON.stringify(formData),
      success: function (response) {
        if (response.success) {
          Swal.fire({
            title: "Успех!",
            text: "Отзыв успешно добавлен",
            icon: "success",
          }).then((result) => {
            if (result.isConfirmed) {
              location.reload();
            }
          });
        } else {
          Swal.fire({
            title: "Ошибка!",
            text: "Произошла ошибка при отправке: " + response.error,
            icon: "error",
          });
        }
      },
      error: function (response, xhr, status, error) {
        var errText =
          "Произошла критическая ошибка при отправке! Повторите попытку отправить позже.";
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
}
