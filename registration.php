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
                        <form action="#" methiod="post" class="register__form">
                                <div class="register__form-box">
                                        <label class="register__form-label" for="login">Login</label>
                                        <input class="register__form-input" type="text" name="login"
                                                placeholder="Login">
                                        <!-- <p class="error">Your login is invalid!!! Change it!!</p> -->
                                </div>
                                <div class="register__form-box">
                                        <label class="register__form-label" for="login">Email</label>
                                        <input class="register__form-input" type="email" name="login"
                                                placeholder="Login">
                                        <!-- <p class="error">Your login is invalid!!! Change it!!</p> -->
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
                                        <p class="error">Password must be identhical</p>
                                </div>
                                <button class="register__form-submit" type="submit">sign up</button>
                        </form>
                </div>
                <div class="register__info">
                        <p>Already have an account? <a href="./loginform.html">Log in</a></p>
                        <p>By signing up with AccountingApp, you agree to our <a href="#">Terms of service</a></p>
                </div>
        </main>
</body>

</html>