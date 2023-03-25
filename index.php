<?php

require 'auth/KeyAuth.php';

if (isset($_SESSION['user_data'])) 
{
	  header("Location: dashboard/");
    exit();
}

$name = ""; // Application name
$ownerid = ""; // Application ownerID
$KeyAuthApp = new KeyAuth\api($name, $ownerid);

if (!isset($_SESSION['sessionid'])) 
{
  	$KeyAuthApp->init();
}
//echo $_SESSION['sessionid']; //Will print current sessionid, that you can make request manually with like postman
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/img/logo0020.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="assets/css/notyf.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="assets/js/notyf.min.js"></script>
</head>

<body>
    <div id="page">
        <div class="hangar-auth">
            <div class="hangar-form">
                <img draggable="false" src="assets/img/logo0021.png" alt="Login" class="hangar-logo">
                <h1 class="hangar-auth_title">
                    <i class="fad fa-sign-in-alt"></i>
                    <span>Login</span>
                </h1>
                <form class="hangar-fieldset2" method="post">
                    <div class="hangarFormControl-root hangarTextField-root jss1" data-validate="Username is required">
                        <label
                            class="hangarFormLabel-root hangarInputLabel-root hangarInputLabel-formControl hangarInputLabel-animated hangarInputLabel-shrink hangarInputLabel-outlined"
                            data-shrink="true">Username</label>
                        <div
                            class="hangarInputBase-root hangarOutlinedInput-root hangarInputBase-formControl hangarInputBase-adornedStart hangarOutlinedInput-adornedStart">
                            <div class="hangarInputAdornment-root hangarInputAdornment-positionStart">
                                <div class="hangarSvgIcon-root" focusable="false" aria-hidden="true">
                                    <i style="color:#7c7c81" class="fa fa-user-circle"></i>
                                </div>
                            </div>
                            <input autocomplete="off" aria-invalid="false" type="text" name="keyauthusername"
                                class="hangarInputBase-input hangarOutlinedInput-input hangarInputBase-inputAdornedStart hangarOutlinedInput-inputAdornedStart"
                                placeholder="Username">
                            <fieldset aria-hidden="true" class="jss2 hangarOutlinedInput-notchedOutline">
                                <legend class="jss4 jss5">
                                    <span>Username</span>
                                </legend>
                            </fieldset>
                        </div>
                    </div>
                    <div class="hangarFormControl-root hangarTextField-root jss1" data-validate="Password is required">
                        <label
                            class="hangarFormLabel-root hangarInputLabel-root hangarInputLabel-formControl hangarInputLabel-animated hangarInputLabel-shrink hangarInputLabel-outlined"
                            data-shrink="true">Password</label>
                        <div
                            class="hangarInputBase-root hangarOutlinedInput-root hangarInputBase-formControl hangarInputBase-adornedStart hangarOutlinedInput-adornedStart">
                            <div class="hangarInputAdornment-root hangarInputAdornment-positionStart">
                                <div class="hangarSvgIcon-root" focusable="false" aria-hidden="true">
                                    <i style="color:#7c7c81" class="fa fa-lock-alt"></i>
                                </div>
                            </div>
                            <input autocomplete="off" aria-invalid="false" type="password" name="keyauthpassword"
                                class="hangarInputBase-input hangarOutlinedInput-input hangarInputBase-inputAdornedStart hangarOutlinedInput-inputAdornedStart"
                                placeholder="Password">
                            <fieldset aria-hidden="true" class="jss2 hangarOutlinedInput-notchedOutline">
                                <legend class="jss4 jss5">
                                    <span>Password</span>
                                </legend>
                            </fieldset>
                        </div>
                    </div>
                    <button name="login"
                        class="hangarButtonBase-root hangarButton-root jss6 hangarButton-text hangarButton-textPrimary">
                        Login </button> &nbsp; <button name=""
                        class="hangarButtonBase-root hangarButton-root jss6 hangarButton-text hangarButton-textPrimary">
                        <a href="./register/" style="text-decoration:none;">Register</a>
                    </button>
                    <div class="flex-sb-m w-full p-t-3 p-b-24">
                        <div></div>
                    </div>
                </form>
                <p class="hangarFormHelperText-root hangarFormHelperText-contained hangar-error hangarFormHelperText-filled"
                    style="text-align:center;">All rights reserved to <a style="text-decoration:none;"
                        href="https://github.com/zetrocode/">ZetroCode</a> 2022 - <?php echo date('Y'); ?> </p>
            </div>
        </div>
    </div>

    <?php if (isset($_POST["login"])) {
        if (
            $KeyAuthApp->login(
                $_POST["keyauthusername"],
                $_POST["keyauthpassword"]
            )
        ) {
            $_SESSION["un"] = $_POST["keyauthusername"];
            echo "<meta http-equiv='Refresh' Content='2; url=dashboard/'>";
            echo '
                        <script type=\'text/javascript\'>
                        
                        const notyf = new Notyf();
                        notyf
                          .success({
                            message: \'You have successfully logged in!\',
                            duration: 3500,
                            dismissible: true
                          });                
                        
                        </script>
                        ';
        }
    } ?>
</body>

</html>