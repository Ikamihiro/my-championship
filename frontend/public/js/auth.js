$(document).ready(function () {
  if (TokenManager.getToken() === false) {
    $(location).attr("href", "/login");
  }

  $("#formLogout").on("submit", function (event) {
    TokenManager.clearToken();
    $(location).attr("href", "/login");
    event.preventDefault();
  });
});
