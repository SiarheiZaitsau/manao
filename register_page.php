<?php  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="styles.css?v=<?php echo time(); ?>" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Home page</title>
  </head>
  <body>
    <form id="register" method="post">
      <h2 class="form__title">Register form</h2>
      <label for="username" class="form__label"> Login </label>
      <input
        id="username"
        placeholder="Enter an username"
        class="form__input"
        type="text"
        name="username"
      />
      <p id="username-error" class="error"> </p>
      <label for="email" class="form__label"> Email </label>
      <input
        id="email"
        placeholder="Enter an email"
        class="form__input"
        type="text"
        name="email"
      />
      <p id="email-error" class="error"> </p>
      <label for="password" class="form__label"> Password </label>
      <input
        id="password"
        placeholder="Enter a password"
        class="form__input"
        type="password"
        name="password"
      />
      <label for="password-repeat" class="form__label">
        Repeat the Password
      </label>
      <input
        id="password-repeat"
        placeholder="Repeat the password"
        class="form__input"
        type="password"
        name="password-repeat"
      />
      <p id="password-error" class="error"> </p>
      <label for="name" class="form__label"> Enter your name </label>
      <input
        id="name"
        placeholder="Enter your name"
        class="form__input"
        type="text"
        name="name"
      />
      <p id="name-error" class="error"> </p>
      <p id="success" class="success"> </p>
      <script type="text/javascript">
        document.write(
          '<input id="register-button" type="submit" value="Register" name="submit" class="form__submit" />'
        );
      </script>
      <p>
        Already have an account?
        <a class="form__navigate" href="login_page.php">Login</a>
      </p>
    </form>
    <script type="text/javascript" src="./js/register.js"></script>
  </body>
</html>
