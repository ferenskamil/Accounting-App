<?php 
        session_start();

        // $user_name = $_SESSION['login'];

        if (isset($_SESSION['is_logged']) && $_SESSION['is_logged']) {
                $user_name = $_SESSION['login'];
                $user_email = $_SESSION['user_email'];
                $user_img = $_SESSION['avatar_img'];

                $account_options = '
                <div class="home__top-right-logged-user"> 
                        <div class="home__top-right-logged-user-info">
                                <img class="home__top-right-logged-user-avatar" src="./assets/img/avatars/'.$user_img.'" alt="user photo">
                                <div>
                                        <p><strong>'.$user_name.'</strong></p>
                                        <p>'.$user_email.'</p>
                                </div>
                        </div>
                        <div class="home__top-right-logged-user-settings">
                                <a href="./dashboard.php"><button>App</button></a>
                                <a href="./php_scripts/logout.php"><button>Log out</button></a>
                        </div>
                </div>';
                        
        } else {
                $account_options = '
                <div class="home__top-right-btns">
                        <a href="./loginform.php">
                                <button class="home__top-right-btn login-btn">Sign in</button>
                        </a>
                        <a href="./registration.php">
                                <button class="home__top-right-btn register-btn">Register</button>
                        </a>
                </div>';
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
                                        <?php echo $account_options ?>
                                </div>
                        </div>
                </div>
        </main>

        <script src="./dist/js/home.min.js"></script>
</body>

</html>