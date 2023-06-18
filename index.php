<?php 
        session_start();

        if ($_SESSION['is_logged']) {
                $account_options = "You are logged!";
        } else {
                $account_options = '<a href="./loginform.php">
                        <button class="home__top-right-btn login-btn">Sign in</button>
                </a>
                <a href="./registration.php">
                        <button class="home__top-right-btn register-btn">Register</button>
                </a>';
        }
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
        <title>Document</title>
</head>

<body>
        <main class="home">
                <div class="container">
                        <div class="home__top">
                                <div class="home__top-left">
                                        <a href="./dashboard.php">
                                                <i class="fa-brands fa-apple"></i>
                                                <h2>AccountingApp</h2>
                                        </a>
                                        <button class="home__top-left-burger-btn"><i class="fa-solid fa-bars"></i></button>
                                </div>

                                <div class="home__top-right">
                                        <ul>
                                                <a href="#">
                                                        <li>Why?</li>
                                                </a>
                                                <a href="#">
                                                        <li>Features</li>
                                                </a>

                                                <a href="#">
                                                        <li>Customers</li>
                                                </a>

                                                <a href="#">
                                                        <li>Pricing</li>
                                                </a>

                                        </ul>
                                        <div class="home__top-right-btns">
                                                <?php echo $account_options ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </main>
</body>

</html>