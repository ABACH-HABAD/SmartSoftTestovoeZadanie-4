document.addEventListener("DOMContentLoaded", function () {
  var userID = sessionStorage.getItem("loginedID");

  const YouHaveAccount = document.getElementById("YouHaveAccount");
  const EmailLogin = document.getElementById("EmailLogin");
  const FormRegistration = document.getElementById("FormRegistration");
  const Layout = document.getElementById("Layout");
  const UserReview = document.getElementById("UserReview");
  const CreateReview = document.getElementById("CreateReview");
  const Form = document.getElementById("FormCreateReview");
  const ReviewButton = document.getElementById("AddReview");
  const YouHaventReview = document.getElementById("YouHaventReview");

  if (userID != null && userID != undefined && userID != "undefined") {
    EmailLogin.style.visibility = "hidden";
    EmailLogin.style.display = "none";
    FormRegistration.style.visibility = "hidden";
    FormRegistration.style.display = "none";

    YouHaveAccount.style.visibility = "hidden";
    YouHaveAccount.style.display = "none";

    Layout.style.visibility = "visible";
    Layout.style.display = "block";

    $.ajax({
      url: "API/Get_review.php",
      type: "GET",
      contentType: "application/json",
      data: { id: userID },
      success: function (response) {
        if (response.success) {
          document.getElementById("reviewName").textContent = response.name;
          document.getElementById("reviewComment").textContent =
            response.comment;
          document.getElementById("InputMessageCreateReview").textContent =
            response.comment;
          ReviewButton.textContent = "Редактировать отзыв";
          YouHaventReview.style.visibility = "hidden";
          YouHaventReview.style.display = "none";
          Form.style.visibility = "hidden";
          Form.style.display = "none";
        } else {
          UserReview.style.visibility = "hidden";
          UserReview.style.display = "none";
          Form.style.visibility = "hidden";
          Form.style.display = "none";
          if (response.error != "Отзыв не найден")
            console.error(
              "Произошла ошибка при загрузке отзыва: " + response.error
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
          UserReview.style.visibility = "hidden";
          UserReview.style.display = "none";
          Form.style.visibility = "hidden";
          Form.style.display = "none";
          if (response.responseJSON.error != "Отзыв не найден") {
            console.error(
              "Произошла ошибка при загрузке отзыва: " +
                response.responseJSON.error
            );
          }
        }
      },
    });

    $.ajax({
      url: "API/Get_user_by_id.php",
      type: "GET",
      contentType: "application/json",
      data: { id: userID },
      success: function (response) {
        if (response.success) {
          document.getElementById("InputName").value = response.name;
          document.getElementById("InputSurname").value = response.surname;
          document.getElementById("InputEmail").value = response.email;
          document.getElementById("InputMessageRegistration").textContent =
            response.message;

          document.getElementById("name").textContent = response.name;
          document.getElementById("surname").textContent = response.surname;
          document.getElementById("email").textContent = response.email;
          document.getElementById("message").textContent = response.message;

          document.getElementById("InputName3").value = response.name;
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
  } else {
    EmailLogin.style.visibility = "hidden";
    EmailLogin.style.display = "none";
    FormRegistration.style.visibility = "hidden";
    FormRegistration.style.display = "none";

    Layout.style.visibility = "hidden";
    Layout.style.display = "none";
  }
});
