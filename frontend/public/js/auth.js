const TokenManager = {
  getToken: () => {
    let valueEncoded = localStorage.getItem("token");
    if (valueEncoded === null) {
      return false;
    }

    return window.atob(valueEncoded);
  },

  setToken: token => {
    let valueEncoded = window.btoa(token);
    localStorage.setItem("token", valueEncoded);
    return true;
  },
};

$(document).ready(function () {
  if (TokenManager.getToken() === false) {
    $(location).attr('href', '/login');
  }
});