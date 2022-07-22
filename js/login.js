$("document").ready(function () {
  $("#login").on("submit", function (e) {
    const data = $("#login").serialize();
    e.preventDefault();
    $.ajax({
      url: "login.php",
      method: "post",
      data,
      success: function (data) {
        console.log(JSON.parse(data));
        window.location.replace("account_page.php");
      },
      error: function (response) {
        const data = JSON.parse(response.responseText);
        const error = data.errors;
        $("#login-error").html(error).css({ display: "block" });
      },
    });
  });
});
