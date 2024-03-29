<?php 
        session_start();

        // $user_name = $_SESSION['login'];

        // Get user data to $user assoc array
        if (isset($_SESSION['user'])) $user = $_SESSION['user'];

        if (isset($user) && $user['is_logged']) {
                $account_options = <<<HTML
                <div class="home__top-right-logged-user"> 
                        <div class="home__top-right-logged-user-info">
                                <img class="home__top-right-logged-user-avatar" src="../assets/user_img/avatars/{$user['avatar']}" alt="user photo">
                                <div>
                                        <p><strong>{$user['login']}</strong></p>
                                        <p>{$user['email']}</p>
                                </div>
                        </div>
                        <div class="home__top-right-logged-user-settings">
                                <a href="./dashboard.php"><button>App</button></a>
                                <a href="./scripts/logout.php"><button>Log out</button></a>
                        </div>
                </div>
                HTML;
                        
        } else {
                $account_options = <<<HTML
                <div class="home__top-right-btns">
                        <a href="./login_form.php">
                                <button class="home__top-right-btn login-btn">Sign in</button>
                        </a>
                        <a href="./registration_form.php">
                                <button class="home__top-right-btn register-btn">Register</button>
                        </a>
                </div>
                HTML;
        }
        
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once '../templates/head_links.php'; ?>
        <title>Document</title>
</head>

<body>
        <main class="home">
                <div class="container">
                        <div class="home__top">
                                <div class="home__top-left">
                                        <a href="./dashboard.php">
                                                <img src="../assets/app_img/icon_white.png" alt="app logo">
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

        <script src="../assets/js/pages/home/home.min.js"></script>
</body>

</html>