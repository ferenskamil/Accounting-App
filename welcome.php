<?php 
        session_start();

        if (!isset($_SESSION['is_registered_success']) && !$_SESSION['is_registered_success']) {
                header('Location: ./registration.php');
                exit();
        } else {
                unset($_SESSION['is_registered_success']);
                
                unset($_SESSION['login']);
                unset($_SESSION['email']);
                unset($_SESSION['pass1']);
                unset($_SESSION['term-of-services']);
        }
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
        <title>Welcome</title>
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
                        <p>You have successfully registered. You can log in now.</p>
                        <a href="./loginform.php"><button>Log in</button></a>
                </div>
        </main>
</body>

</html>