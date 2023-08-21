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
                                                        if (isset($_SESSION['login'])) echo $_SESSION['login'];
                                                ?>">
                                        <p class="error"><?php 
                                                if (isset( $_SESSION['e_login'])) echo $_SESSION['e_login'];
                                        ?></p>
                                </div>
                                <div class="register__form-box">
                                        <label class="register__form-label" for="email">Email</label>
                                        <input class="register__form-input" type="email" name="email"
                                                placeholder="email" value="<?php 
                                                        if (isset($_SESSION['email'])) echo $_SESSION['email'];
                                                ?>">
                                        <p class="error"><?php 
                                                if (isset( $_SESSION['e_email'])) echo $_SESSION['e_email'];
                                        ?></p>
                                </div>
                                <div class="register__form-box">
                                        <label class="register__form-label" for="password1">Password</label>
                                        <input class="register__form-input" type="password" name="password1"
                                                placeholder="Password" value="<?php 
                                                        if (isset($_SESSION['pass1'])) echo $_SESSION['pass1'];
                                                ?>">
                                        <p class="error"><?php 
                                                if (isset( $_SESSION['e_pass1'])) echo $_SESSION['e_pass1'];
                                        ?></p>
                                </div>
                                <div class="register__form-box">
                                        <label class="register__form-label" for="password2">Repeat password</label>
                                        <input class="register__form-input" type="password" name="password2"
                                                placeholder="Repeat password">
                                        <p class="error"><?php 
                                                if (isset( $_SESSION['e_pass2'])) echo $_SESSION['e_pass2'];
                                        ?></p>                                
                                </div>
                                <div class="register__form-box term-of-services-box">
                                        <label for="term-of-services">
                                        <input type="checkbox" name="term-of-services" id="term-of-services" <?php 
                                                if (isset($_SESSION['term-of-services']) && $_SESSION['term-of-services']) {
                                                        echo 'checked';
                                                } ?>>
                                        I agree with the term of services
                                        </label>  
                                        <p class="error"><?php 
                                                if (isset($_SESSION['e_term_of_services'])) echo $_SESSION['e_term_of_services'];
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