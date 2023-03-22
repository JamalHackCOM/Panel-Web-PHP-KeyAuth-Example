<?php
require 'KeyAuth.php';

// Redirect to dashboard if user is already logged in
if (isset($_SESSION['user_data'])) {
  header("Location: dashboard/");
  exit();
}

$name = ""; // Application name
$ownerid = ""; // Application ownerID
$KeyAuthApp = new KeyAuth\api($name, $ownerid);

// Initialize the session if it hasn't been initialized yet
if (!isset($_SESSION['sessionid'])) {
  $KeyAuthApp->init();
}

// Uncomment if you want to print the current session id for manual requests using postman
// echo $_SESSION['sessionid'];

if (isset($_POST['register'])) {
    if ($KeyAuthApp->register($_POST['username'], $_POST['password'], $_POST['license'])) {
        $_SESSION['un'] = $_POST['username'];
        echo "<meta http-equiv='Refresh' Content='2; url=../dashboard/'>";
        echo '
            <script type="text/javascript">
                const notyf = new Notyf();
                notyf.success({
                    message: "You have successfully registered!",
                    duration: 3500,
                    dismissible: true
                });
            </script>
        ';
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div id="page">
      <div class="hangar-auth">
        <div class="hangar-form">
          <img draggable="false" src="/img/logo0021.png" alt="Login" class="hangar-logo">
          <h1 class="hangar-auth_title">
            <i class="fad fa-user-plus"></i>
            <span>Register</span>
          </h1>
          <form class="hangar-fieldset2" method="post">
            <div class="hangarFormControl-root hangarTextField-root jss1" data-validate="Username is required">
              <label class="hangarFormLabel-root hangarInputLabel-root hangarInputLabel-formControl hangarInputLabel-animated hangarInputLabel-shrink hangarInputLabel-outlined" data-shrink="true">Username</label>
              <div class="hangarInputBase-root hangarOutlinedInput-root hangarInputBase-formControl hangarInputBase-adornedStart hangarOutlinedInput-adornedStart">
                <div class="hangarInputAdornment-root hangarInputAdornment-positionStart">
                  <div class="hangarSvgIcon-root" focusable="false" aria-hidden="true">
                    <i style="color:#7c7c81" class="fa fa-user-circle"></i>
                  </div>
                </div>
                <input autocomplete="off" aria-invalid="false" type="text" name="username" class="hangarInputBase-input hangarOutlinedInput-input hangarInputBase-inputAdornedStart hangarOutlinedInput-inputAdornedStart" placeholder="Username">
                <fieldset aria-hidden="true" class="jss2 hangarOutlinedInput-notchedOutline">
                  <legend class="jss4 jss5">
                    <span>Username</span>
                  </legend>
                </fieldset>
              </div>
            </div>
            <div class="hangarFormControl-root hangarTextField-root jss1" data-validate="Password is required">
              <label class="hangarFormLabel-root hangarInputLabel-root hangarInputLabel-formControl hangarInputLabel-animated hangarInputLabel-shrink hangarInputLabel-outlined" data-shrink="true">Password</label>
              <div class="hangarInputBase-root hangarOutlinedInput-root hangarInputBase-formControl hangarInputBase-adornedStart hangarOutlinedInput-adornedStart">
                <div class="hangarInputAdornment-root hangarInputAdornment-positionStart">
                  <div class="hangarSvgIcon-root" focusable="false" aria-hidden="true">
                    <i style="color:#7c7c81" class="fa fa-lock-alt"></i>
                  </div>
                </div>
                <input autocomplete="off" aria-invalid="false" type="password" name="password" class="hangarInputBase-input hangarOutlinedInput-input hangarInputBase-inputAdornedStart hangarOutlinedInput-inputAdornedStart" placeholder="Password">
                <fieldset aria-hidden="true" class="jss2 hangarOutlinedInput-notchedOutline">
                  <legend class="jss4 jss5">
                    <span>Password</span>
                  </legend>
                </fieldset>
              </div>
            </div>
            <div class="hangarFormControl-root hangarTextField-root jss1" data-validate="Password is required">
              <label class="hangarFormLabel-root hangarInputLabel-root hangarInputLabel-formControl hangarInputLabel-animated hangarInputLabel-shrink hangarInputLabel-outlined" data-shrink="true">License</label>
              <div class="hangarInputBase-root hangarOutlinedInput-root hangarInputBase-formControl hangarInputBase-adornedStart hangarOutlinedInput-adornedStart">
                <div class="hangarInputAdornment-root hangarInputAdornment-positionStart">
                  <div class="hangarSvgIcon-root" focusable="false" aria-hidden="true">
                    <i style="color:#7c7c81" class="fa fa-key"></i>
                  </div>
                </div>
                <input autocomplete="off" aria-invalid="false" type="text" name="license" class="hangarInputBase-input hangarOutlinedInput-input hangarInputBase-inputAdornedStart hangarOutlinedInput-inputAdornedStart" placeholder="License">
                <fieldset aria-hidden="true" class="jss2 hangarOutlinedInput-notchedOutline">
                  <legend class="jss4 jss5">
                    <span>License</span>
                  </legend>
                </fieldset>
              </div>
            </div>
            <button name="register" class="hangarButtonBase-root hangarButton-root jss6 hangarButton-text hangarButton-textPrimary"> Register </button> &nbsp; <button name="" class="hangarButtonBase-root hangarButton-root jss6 hangarButton-text hangarButton-textPrimary">
              <a href="/" style="text-decoration:none;"> Login </a>
            </button>
            <div class="flex-sb-m w-full p-t-3 p-b-24">
              <div></div>
            </div>
          </form>
          <p class="hangarFormHelperText-root hangarFormHelperText-contained hangar-error hangarFormHelperText-filled" style="text-align:center;">All rights reserved to <a style="text-decoration:none;" href="https://mrgarabato.com/">MrGarabato</a> 2022 </p>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
  </body>
</html>
