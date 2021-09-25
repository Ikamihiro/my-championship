$(document).ready(function () {
  if (TokenManager.getToken() === false) {
    $(location).attr('href', '/login');
  }
});