$(document).ready(function () {
  $("#LogoutButton").on("click", Logout);
});

function Logout() {
  if (
    sessionStorage.getItem("loginedID") == null ||
    sessionStorage.getItem("loginedID") == undefined ||
    sessionStorage.getItem("loginedID") == "undefined"
  ) {
    Swal.fire({
      icon: "info",
      title: "Невозможно выйти",
      text: "Чтобы выйти из аккаунта, надо для начала в него зайти",
    });
    return;
  }
  Swal.fire({
    icon: "question",
    showDenyButton: true,
    confirmButtonText: "Да, выйти",
    denyButtonText: "Нет, ненадо",
    title: "Выход",
    text: "Вы точно хотите выйти из аккаунта?",
  }).then((result) => {
    if (result.isConfirmed) {
      sessionStorage.removeItem("loginedID");
      location.reload();
    }
  });
}
