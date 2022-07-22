<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css?v=<?php echo time(); ?>" />
    <title>Log in form</title>
  </head>
  <body>
    <form id="login" method="post">
      <h2 class="form__title">Login form</h2>
      <label class="form__label"> Username </label>
      <input
        class="form__input"
        placeholder="Enter an username"
        type="text"
        name="username"
      />
      <label class="form__label"> Password </label>
      <input
        class="form__input"
        placeholder="Enter a password"
        type="password"
        name="password"
      />
      <p id="login-error" class="error"> </p>
      <script type="text/javascript">
        document.write(
          '<input id="login-button" type="submit" value="Login" name="submit" class="form__submit" />'
        );
      </script>
      <p>
        Don't have an account?
        <a class="form__navigate" href="register_page.php">Register</a>
      </p>
    </form>
    <script type="text/javascript" src="./js/login.js"></script>
  </body>
</html>
