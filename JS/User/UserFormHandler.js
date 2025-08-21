async function Registration(event) {
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
    name: $("#InputName").val(),
    surname: $("#InputSurname").val(),
    email: $("#InputEmail").val(),
    message: $("#InputMessageRegistration").val(),
    id: sessionStorage.getItem("loginedID"),
  };

  var Edit = editAccountTitle.textContent == "Редактирование профиля";

  await $.ajax({
    url: Edit ? "API/Edit_user.php" : "API/Add_user.php",
    type: "POST",
    contentType: "application/json",
    data: JSON.stringify(formData),
    success: function (response) {
      if (!response.success) {
        Swal.fire({
          title: "Ошибка!",
          text: "Произошла ошибка при отправке: " + response.error,
          icon: "error",
        });
        return;
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
      return;
    },
  });

  $.ajax({
    url: "API/Get_user_by_email.php",
    type: "GET",
    contentType: "application/json",
    data: { email: formData.email },
    success: function (response) {
      if (response.success) {
        sessionStorage.setItem("loginedID", response.id);
        Swal.fire({
          title: "Успех!",
          text: Edit
            ? "Данные пользователя успешно изменены"
            : "Пользователь успешно зарегестрирован",
          icon: "success",
        }).then((result) => {
          if (result.isConfirmed) {
            location.reload();
          }
        });
      } else {
        console.error(
          "Произошла ошибка при загрузке пользователя: " + response.error
        );
      }
    },
    error: function (response, xhr, status, error) {
      if (
        response.responseJSON != null &&
        response.responseJSON != undefined &&
        response.responseJSON.error != undefined &&
        response.responseJSON.error != null
      ) {
        console.error(
          "Произошла ошибка при загрузке пользователя: " +
            response.responseJSON.error
        );
      }
    },
  });
}

function Authorization(event) {
  event.preventDefault();

  var exMessage = "";

  if ($("#InputLogin").val().length < 1) {
    exMessage += "Введите электронную почту<br>";
  }

  if (exMessage) {
    Swal.fire("Неверные данные", exMessage, "error");
    return;
  }

  $.ajax({
    url: "API/Get_user_by_email.php",
    type: "GET",
    contentType: "application/json",
    data: { email: $("#InputLogin").val() },
    success: function (response) {
      if (response.success) {
        sessionStorage.setItem("loginedID", response.id);
        Swal.fire({
          title: "Успех!",
          text: "Вы успешно вошли в аккаунт",
          icon: "success",
        }).then((result) => {
          if (result.isConfirmed) {
            location.reload();
          }
        });
      } else {
        if (response.error == "Пользователь не найден") {
          Swal.fire({
            title: "Не удалось войти",
            text: "Такого аккаунта не существует",
            icon: "error",
          });
        } else {
          console.error(
            "Произошла ошибка при загрузке пользователя: " + response.error
          );
        }
      }
    },
    error: function (response, xhr, status, error) {
      if (
        response.responseJSON != null &&
        response.responseJSON != undefined &&
        response.responseJSON.error != undefined &&
        response.responseJSON.error != null
      ) {
        if (response.responseJSON.error == "Пользователь не найден") {
          Swal.fire({
            title: "Не удалось войти",
            text: "Такого аккаунта не существует",
            icon: "error",
          });
        } else {
          console.error(
            "Произошла ошибка при загрузке пользователя: " +
              response.responseJSON.error
          );
        }
      }
    },
  });
}

function CreateReview(event) {
  event.preventDefault();

  var exMessage = "";

  if (
    sessionStorage.getItem("loginedID") == null ||
    sessionStorage.getItem("loginedID") == undefined ||
    sessionStorage.getItem("loginedID") == "undefined"
  ) {
    exMessage +=
      "Перед тем как оставить отзыв войдите в аккаунт или зарегестрируйтесь<br>";
  }

  if ($("#InputName3").val().length < 3) {
    if ($("#InputName3").val().length < 1) exMessage += "Введите имя<br>";
    else
      exMessage +=
        "Имя слишком короткое. Минимальная дланна имени 3 символа<br>";
  }

  if ($("#InputMessageCreateReview").val().length < 1) {
    exMessage += "Введите сообщение<br>";
  }

  if (exMessage) {
    Swal.fire("Неверные данные", exMessage, "error");
    return;
  }

  var formData = {
    id: sessionStorage.getItem("loginedID"),
    comment: $("#InputMessageCreateReview").val(),
  };

  $.ajax({
    url: "API/Add_review.php",
    type: "POST",
    contentType: "application/json",
    data: JSON.stringify(formData),
    success: function (response) {
      if (response.success) {
        Swal.fire({
          title: "Успех!",
          text: "Ваш отзыв успешно оставлен",
          icon: "success",
        }).then((result) => {
          if (result.isConfirmed) {
            location.reload();
          }
        });
      } else {
        Swal.fire({
          title: "Ошибка!",
          text: "Произошла ошибка при отправке! " + response.error,
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
