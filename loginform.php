<?php 
        session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- FontAwesome Kit -->
<script src="https://kit.fontawesome.com/63681c7143.js" crossorigin="anonymous"></script>

<!-- Poppins - GoogleFonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<!-- CSS stylesheet -->
<link rel="stylesheet" href="./dist/css/main.min.css">
        <title>Login</title>
</head>

<body>
        <main class="register">
                <a href="./index.php">
                        <div class="register__top">
                                <i class="fa-brands fa-apple"></i>
                                <h2>AccountingApp</h2>
                        </div>
                </a>
                <h1 class="register__title">Sign in</h1>
                <div class="register__wrapper">
                        <form action="./php_scripts/login.php" method="post" class="register__form">
                                <div class="register__form-box">
                                        <label class="register__form-label" for="login">Login</label>
                                        <input class="register__form-input" type="text" name="login"
                                                placeholder="Login" value="<?php if(isset($_SESSION['login'])) echo $_SESSION['login'] ?>">
                                        <p class="error"><?php if (isset($_SESSION['log_error_login'])) echo $_SESSION['log_error_login'] ?></p>
                                </div>
                                <div class="register__form-box">
                                        <label class="register__form-label" for="password1">Password</label>
                                        <input class="register__form-input" type="password" name="password1"
                                                placeholder="Password">
                                        <p class="error"><?php if (isset($_SESSION['log_error_pass'])) echo $_SESSION['log_error_pass'] ?></p>
                                </div>
                                <button class="register__form-submit" type="submit" name="submit">sign in</button>
                        </form>
                </div>
                <div class="register__info">
                        <p>Forgot your password? <a href="#">Reset password</a></p>
                        <p>No account? <a href="./registration.php">Create one</a></p>
                </div>
        </main>
</body>

</html>