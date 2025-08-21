document.addEventListener("DOMContentLoaded", function () {
  const textarea1 = document.getElementById("InputMessageRegistration");
  const textarea2 = document.getElementById("InputMessageOrder");
  const textarea3 = document.getElementById("InputMessageCreateReview");
  textarea1.style.height = "100px";
  textarea2.style.height = "100px";
  textarea3.style.height = "100px";

  if (
    sessionStorage.getItem("loginedID") != null &&
    sessionStorage.getItem("loginedID") != undefined &&
    sessionStorage.getItem("loginedID") != "undefined"
  ) {
    $.ajax({
      url: "API/Get_user_by_id.php",
      type: "GET",
      contentType: "application/json",
      data: { id: sessionStorage.getItem("loginedID") },
      success: function (response) {
        if (response.success) {
          if (response.name != null)
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
  }
});

document
  .getElementById("InputMessageRegistration")
  .addEventListener("input", function () {
    this.style.height = "auto";
    this.style.height = Math.max(this.scrollHeight, 100) + "px";
  });

document
  .getElementById("InputMessageOrder")
  .addEventListener("input", function () {
    this.style.height = "auto";
    this.style.height = Math.max(this.scrollHeight, 100) + "px";
  });

document
  .getElementById("InputMessageCreateReview")
  .addEventListener("input", function () {
    this.style.height = "auto";
    this.style.height = Math.max(this.scrollHeight, 100) + "px";
  });
