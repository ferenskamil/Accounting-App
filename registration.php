<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="./dist/css/main.min.css">

        <!-- FontAwesome Kit -->
<script src="https://kit.fontawesome.com/63681c7143.js" crossorigin="anonymous"></script>

<!-- Poppins - GoogleFonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <title>Register</title>
</head>
<!-- I used styles for registration form. In the future I want to pull it to independent -->

<body>
        <main class="register">
                <div class="register__top">
                        <i class="fa-brands fa-apple"></i>
                        <h2>AccountingApp</h2>
                </div>
                <h1 class="register__title">Sign up</h1>
                <div class="register__wrapper">
                        <form action="./php_scripts/register.php" method="post" class="register__form">
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
                                                placeholder="Password">
                                        <!-- <p class="error">Your password must consist of 8 charactaer and ate least on big letter</p> -->
                                </div>
                                <div class="register__form-box">
                                        <label class="register__form-label" for="password2">Repeat password</label>
                                        <input class="register__form-input" type="password" name="password2"
                                                placeholder="Repeat password">
                                        <!-- <p class="error">Password must be identhical</p> -->
                                </div>
                                <div class="register__form-box term-of-services">
                                      <label for="term-of-services">
                                        <input type="checkbox" name="term-of-services" id="term-of-services" <?php 
                                                if (isset($_SESSION['term-of-services']) && $_SESSION['term-of-services']) echo "checked";
                                        ?>>
                                        I agree with the term of services
                                      </label>  
                                </div>
                                <button class="register__form-submit" type="submit">Sign up</button>
                        </form>
                </div>
                <div class="register__info">
                <p>Already have an account? <a href="./loginform.php">Log in</a></p>
                        <p>By signing up with AccountingApp, you agree to our <a href="#">Terms of service</a></p>
                </div>
        </main>
</body>

</html>