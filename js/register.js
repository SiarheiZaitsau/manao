$("document").ready(function () {
  $("#register").on("submit", function (e) {
    const data = $("#register").serialize();
    e.preventDefault();
    $.ajax({
      url: "register.php",
      method: "post",
      data,
      success: function (data) {
        const result = data.trim();
        $("#username-error, #email-error, #password-error, #name-error")
          .html("")
          .css({ display: "none" });
        $("#register")[0].reset();
        $("#success")
          .html("User successfully registered")
          .css({ display: "block" });
      },
      error: function (response) {
        const data = JSON.parse(response.responseText);
        const errors = data.errors;
        $("#success").html("").css({ display: "none" });
        for (let err in errors) {
          console.log(err);
          if (err === "username") {
            $("#username-error").html(errors[err]).css({ display: "block" });
          }
          if ((err = "email")) {
            $("#email-error").html(errors[err]).css({ display: "block" });
          }
          if ((err = "password")) {
            $("#password-error").html(errors[err]).css({ display: "block" });
          }
          if ((err = "name")) {
            $("#name-error").html(errors[err]).css({ display: "block" });
          }
        }
      },
    });
  });
});
