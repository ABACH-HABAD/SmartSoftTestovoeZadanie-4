document.addEventListener("DOMContentLoaded", function () {
  const Form = document.getElementById("FormRegistration");
  Form.className = "nestedForm";
  Form.style.marginBottom = 0;
  Form.style.visibility = "hidden";
  Form.style.display = "none";
});

$(document).ready(function () {
  $("#FormRegistration").on("submit", sendForm1);
  $(document).on("click", "#addAccount", function () {
    const Form = document.getElementById("FormRegistration");
    Form.reset();
    document.getElementById("InputMessageRegistration").textContent = "";
    if (
      Form.style.visibility == "hidden" ||
      (Form.style.visibility == "visible" &&
        document.getElementById("editAccountTitle").textContent ==
          "Редактирование аккаунта")
    ) {
      Form.style.visibility = "visible";
      Form.style.display = "block";
      document.getElementById("editAccountTitle").textContent =
        "Создание нового аккаунта";
      document.getElementById("Send").textContent = "Отправить";
    } else {
      Form.style.visibility = "hidden";
      Form.style.display = "none";
    }
  });
});

function sendForm1(event) {
  event.preventDefault();

  var exMessage = "";
  if ($("#InputName").val().length < 3) {
    if ($("#InputName").val().length < 1) exMessage += "Введите имя<br>";
    else
      exMessage +=
        "Имя слишком короткое. Минимальная дланна имени 3 символа<br>";
  }
  if ($("#InputEmail").val().length < 1) {
    exMessage += "Введите электронную почту<br>";
  }
  if ($("#InputMessageRegistration").val().length < 1) {
    exMessage += "Введите сообщение<br>";
  }

  if (exMessage) {
    Swal.fire("Неверные данные", exMessage, "error");
    return;
  }

  var formData = {
    id: $("#InputID").val(),
    name: $("#InputName").val(),
    surname: $("#InputSurname").val(),
    email: $("#InputEmail").val(),
    message: $("#InputMessageRegistration").val(),
  };

  if (
    document.getElementById("editAccountTitle").textContent ==
    "Редактирование аккаунта"
  ) {
    $.ajax({
      url: "API/Edit_user.php",
      type: "POST",
      contentType: "application/json",
      data: JSON.stringify(formData),
      success: function (response) {
        if (response.success) {
          Swal.fire({
            title: "Успех!",
            text: "Данные пользователя успешно обновлены",
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
      url: "API/Add_user.php",
      type: "POST",
      contentType: "application/json",
      data: JSON.stringify(formData),
      success: function (response) {
        if (response.success) {
          Swal.fire({
            title: "Успех!",
            text: "Пользователь успешно зарегестрирован",
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
