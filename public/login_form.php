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
        <title>Login</title>
</head>

<body>
        <main class="register">
                <a href="./index.php">
                        <div class="register__top">
                                <img src="./../assets/app_img/icon_white.png" alt="app logo">
                                <h2>AccountingApp</h2>
                        </div>
                </a>
                <h1 class="register__title">Sign in</h1>
                <div class="register__wrapper">
                        <form action="./scripts/login.php" method="post" class="register__form">
                                <div class="register__form-box">
                                        <label class="register__form-label" for="login">Login</label>
                                        <input class="register__form-input" type="text" name="login"
                                                placeholder="Login" value="<?php
                                                if(isset($_SESSION['login']))
                                                {
                                                        echo $_SESSION['login'];
                                                        unset($_SESSION['login']);
                                                }
                                                ?>">
                                        <p class="error"><?php
                                                if (isset($_SESSION['e_login']))
                                                {
                                                        echo $_SESSION['e_login'];
                                                        unset($_SESSION['e_login']);
                                                }
                                                ?></p>
                                </div>
                                <div class="register__form-box">
                                        <label class="register__form-label" for="password1">Password</label>
                                        <input class="register__form-input" type="password" name="password1"
                                                placeholder="Password">
                                        <p class="error"><?php
                                                if (isset($_SESSION['e_pass']))
                                                {
                                                         echo $_SESSION['e_pass'];
                                                         unset($_SESSION['e_pass']);
                                                }
                                                ?></p>
                                </div>
                                <button class="register__form-submit" type="submit" name="submit">sign in</button>
                        </form>
                </div>
                <div class="register__info">
                        <p>Forgot your password? <a href="#">Reset password</a></p>
                        <p>No account? <a href="./registration_form.php">Create one</a></p>
                </div>
        </main>
</body>

</html>