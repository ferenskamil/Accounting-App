<?php 
        session_start();

        if (!isset($_SESSION['registration_success']) && !$_SESSION['registration_success']) {
                header('Location: ./registration.php');
                exit();
        } else {
                unset($_SESSION['registration_success']);
        }
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once '../templates/head_links.php'; ?>
        <title>Welcome</title>
</head>

<body>
        <main class="welcome">
                <div class="welcome__top">
                        <a href="./index.php">
                                <img src="./dist/img/app_icon_white.png" alt="app logo">
                                <h2>AccountingApp</h2>
                        </a>
                </div>
                <h1 class="welcome__title">Welcome</h1>
                <div class="welcome__wrapper">
                        <p>Thank you for registering with Accounting App. Your account has been successfully created.</p>
                        <!-- <p>An activation link has been sent to your email. If the message did not arrive, 
                                <a href="#" class="send-again">send the activation link again.</a>
                        </p> -->
                        <a href="./login_form.php">
                                <button class="welcome__wrapper-btn">Log in</button>
                        </a>
                </div>
        </main>
</body>

</html>