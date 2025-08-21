document.addEventListener("DOMContentLoaded", function () {
  const Form = document.getElementById("FormCreateReview");
  Form.style.visibility = "hidden";
  Form.style.display = "none";
});

$(document).ready(function () {
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
});
