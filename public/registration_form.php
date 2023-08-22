<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once '../templates/head_links.php'; ?>
        <title>Register</title>
</head>
<!-- I used styles for registration form. In the future I want to pull it to independent -->

<body>
        <main class="register">
                <a href="./index.php">
                        <div class="register__top">
                                <img src="./../assets/app_img/icon_white.png" alt="app logo">
                                <h2>AccountingApp</h2>
                        </div>
                </a>
                <h1 class="register__title">Sign up</h1>
                <div class="register__wrapper">
                        <form action="./scripts/register.php" method="post" class="register__form">
                                <div class="register__form-box">
                                        <label class="register__form-label" for="login">Login</label>
                                        <input class="register__form-input" type="text" name="login"
                                                placeholder="Login" value="<?php 
                                                        if (isset($_SESSION['login']))
                                                        {
                                                                echo $_SESSION['login'];
                                                                unset($_SESSION['login']);
                                                        }
                                                ?>">
                                        <p class="error"><?php 
                                                if (isset( $_SESSION['e_login']))
                                                {
                                                        echo $_SESSION['e_login'];
                                                        unset($_SESSION['e_login']);
                                                }
                                        ?></p>
                                </div>
                                <div class="register__form-box">
                                        <label class="register__form-label" for="email">Email</label>
                                        <input class="register__form-input" type="email" name="email"
                                                placeholder="email" value="<?php 
                                                        if (isset($_SESSION['email']))
                                                        {
                                                                echo $_SESSION['email'];
                                                                unset($_SESSION['email']);
                                                        }?>">
                                        <p class="error"><?php 
                                                if (isset( $_SESSION['e_email']))
                                                {
                                                        echo $_SESSION['e_email'];
                                                        unset($_SESSION['e_email']);
                                                }
                                        ?></p>
                                </div>
                                <div class="register__form-box">
                                        <label class="register__form-label" for="password1">Password</label>
                                        <input class="register__form-input" type="password" name="password1"
                                                placeholder="Password" value="<?php 
                                                        if (isset($_SESSION['password1']))
                                                        {
                                                                echo $_SESSION['password1'];
                                                                unset($_SESSION['password1']);
                                                        }
                                                ?>">
                                        <p class="error"><?php 
                                                if (isset( $_SESSION['e_pass1']))
                                                {
                                                        echo $_SESSION['e_pass1'];
                                                        unset($_SESSION['e_pass1']);
                                                }
                                        ?></p>
                                </div>
                                <div class="register__form-box">
                                        <label class="register__form-label" for="password2">Repeat password</label>
                                        <input class="register__form-input" type="password" name="password2"
                                                placeholder="Repeat password">
                                        <p class="error"><?php 
                                                if (isset( $_SESSION['e_pass2']))
                                                {
                                                        echo $_SESSION['e_pass2'];
                                                        unset($_SESSION['e_pass2']);
                                                }
                                        ?></p>                                
                                </div>
                                <div class="register__form-box regulations-box">
                                        <label for="regulations">
                                        <input type="checkbox" name="regulations" id="regulations"<?php
                                                if (isset($_SESSION['regulations']) && $_SESSION['regulations']) {
                                                        echo 'checked';
                                                        unset($_SESSION['regulations']);
                                                }
                                                ?>>
                                        I agree with the regulations
                                        </label>  
                                        <p class="error"><?php
                                                if (isset($_SESSION['e_regulations']))
                                                {
                                                        echo $_SESSION['e_regulations'];
                                                        unset($_SESSION['e_regulations']);
                                                }
                                        ?></p>                               
                                </div>
                                <button class="register__form-submit" type="submit">Sign up</button>
                        </form>
                </div>
                <div class="register__info">
                <p>Already have an account? <a href="./login_form.php">Log in</a></p>
                        <p>By signing up with AccountingApp, you agree to our <a href="#">Terms of service</a></p>
                </div>
        </main>
</body>

</html>