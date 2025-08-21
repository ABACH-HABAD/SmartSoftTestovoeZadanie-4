$(document).ready(function () {
  $("#FormRegistration").on("submit", Registration);
  $("#EmailLogin").on("submit", Authorization);
  $("#FormCreateReview").on("submit", CreateReview);

  const EmailLogin = document.getElementById("EmailLogin");
  const FormRegistration = document.getElementById("FormRegistration");
  const UserData = document.getElementById("userData");

  $(document).on("click", "#SelectLogin", function () {
    if (EmailLogin.style.visibility == "hidden") {
      EmailLogin.style.visibility = "visible";
      EmailLogin.style.display = "block";
      FormRegistration.style.visibility = "hidden";
      FormRegistration.style.display = "none";
    } else {
      EmailLogin.style.visibility = "hidden";
      EmailLogin.style.display = "none";
    }
  });

  $(document).on("click", "#SelectRegistration", function () {
    if (FormRegistration.style.visibility == "hidden") {
      FormRegistration.style.visibility = "visible";
      FormRegistration.style.display = "block";
      EmailLogin.style.visibility = "hidden";
      EmailLogin.style.display = "none";
    } else {
      FormRegistration.style.visibility = "hidden";
      FormRegistration.style.display = "none";
    }
  });

  $(document).on("click", "#AddReview", function () {
    const Form = document.getElementById("FormCreateReview");
    if (Form.style.visibility == "hidden") {
      Form.style.visibility = "visible";
      Form.style.display = "block";
    } else {
      Form.style.visibility = "hidden";
      Form.style.display = "none";
    }
  });

  $(document).on("click", "#EditUser", function () {
    const EditTitle = document.getElementById("editAccountTitle");
    if (FormRegistration.style.visibility == "hidden") {
      EditTitle.textContent = "Редактирование профиля";
      FormRegistration.style.visibility = "visible";
      FormRegistration.style.display = "block";

      UserData.style.visibility = "hidden";
      UserData.style.display = "none";
    } else {
      EditTitle.textContent = null;
      FormRegistration.style.visibility = "hidden";
      FormRegistration.style.display = "none";

      UserData.style.visibility = "visible";
      UserData.style.display = "block";
    }
  });
});
