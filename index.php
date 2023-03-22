<?php

require 'KeyAuth.php';

// Redirect to dashboard if user is already logged in
if (isset($_SESSION['user_data'])) 
{
  header("Location: dashboard/");
  exit();
}

$name = ""; // Application name
$ownerid = ""; // Application ownerID
$KeyAuthApp = new KeyAuth\api($name, $ownerid);

// Initialize the session if it hasn't been initialized yet
if (!isset($_SESSION['sessionid'])) 
{
  $KeyAuthApp->init();
}

// Uncomment if you want to print the current session id for manual requests using postman
// echo $_SESSION['sessionid'];

if (isset($_POST['login']))
{
    if($KeyAuthApp->login($_POST['keyauthusername'],$_POST['keyauthpassword']))
    {
        header("Location: ./dashboard/");
        exit();
    }
    else
    {
        echo "<script>
            const notyf = new Notyf({
                duration: 4000,
                position: {
                    x: 'center',
                    y: 'top',
                },
                types: [
                    {
                        type: 'error',
                        background: '#ff4d4d',
                        icon: {
                            className: 'fas fa-exclamation-triangle',
                            tagName: 'span',
                            color: '#fff'
                          }
                    }
                ]
            });
            notyf.error('Invalid username or password');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link rel="shortcut icon" href="/img/logo0020.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  </head>
  </head>
  <body>
    <div id="page">
      <div class="hangar-auth">
        <div class="hangar-form">
          <img draggable="false" src="/img/logo0021.png" alt="Login" class="hangar-logo">
          <h1 class="hangar-auth_title">
            <i class="fad fa-sign-in-alt"></i>
            <span>Login</span>
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
                <input autocomplete="off" aria-invalid="false" type="text" name="keyauthusername" class="hangarInputBase-input hangarOutlinedInput-input hangarInputBase-inputAdornedStart hangarOutlinedInput-inputAdornedStart" placeholder="Username">
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
                <input autocomplete="off" aria-invalid="false" type="password" name="keyauthpassword" class="hangarInputBase-input hangarOutlinedInput-input hangarInputBase-inputAdornedStart hangarOutlinedInput-inputAdornedStart" placeholder="Password">
                <fieldset aria-hidden="true" class="jss2 hangarOutlinedInput-notchedOutline">
                  <legend class="jss4 jss5">
                    <span>Password</span>
                  </legend>
                </fieldset>
              </div>
            </div>
            <button name="login" class="hangarButtonBase-root hangarButton-root jss6 hangarButton-text hangarButton-textPrimary"> Login </button> &nbsp; <button name="" class="hangarButtonBase-root hangarButton-root jss6 hangarButton-text hangarButton-textPrimary">
              <a href="./register/" style="text-decoration:none;">Register</a>
            </button>
            <div class="flex-sb-m w-full p-t-3 p-b-24">
              <div></div>
            </div>
          </form>
          <p class="hangarFormHelperText-root hangarFormHelperText-contained hangar-error hangarFormHelperText-filled" style="text-align:center;">All rights reserved to <a style="text-decoration:none;" href="https://github.com/zetrocode/">ZetroCode</a> 2022 - <?php echo date('Y'); ?> </p>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
  </body>
</html>
