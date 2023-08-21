<?php

session_start();

// Get user data to $user assoc array
if (isset($_SESSION['user'])) $user = $_SESSION['user'];

if (isset($_POST['settings-company-name'])) {
        require_once 'db_database.php';

        // Change user company values in db
        $db_query = $db->prepare("UPDATE users SET 
                company_name = :company_name,
                address1 = :address1,
                address2 = :address2,
                company_number = :company_number,
                default_invoice_city = :city,
                default_invoice_bank_name = :bank_name,
                default_invoice_bank_account_no = :account_no,
                default_invoice_additional_info = :additional_info
         WHERE 
                id = :user_id");
        $db_query->bindvalue(':company_name', $_POST['settings-company-name'], PDO::PARAM_STR);
        $db_query->bindvalue(':address1', $_POST['settings-company-address1'], PDO::PARAM_STR);
        $db_query->bindvalue(':address2', $_POST['settings-company-address2'], PDO::PARAM_STR);
        $db_query->bindvalue(':company_number', $_POST['settings-company-number'], PDO::PARAM_STR);
        $db_query->bindvalue(':city', $_POST['settings-invoice-city'], PDO::PARAM_STR);
        $db_query->bindvalue(':bank_name', $_POST['settings-invoice-bank'], PDO::PARAM_STR);
        $db_query->bindvalue(':account_no', $_POST['settings-invoice-account-no'], PDO::PARAM_STR);
        $db_query->bindvalue(':additional_info', $_POST['settings-additional-info'], PDO::PARAM_STR);
        $db_query->bindvalue(':user_id', $user['id'], PDO::PARAM_INT);
        $db_query->execute();

        // Change data in $user assoc array
        $user['company'] = $_POST['settings-company-name'];
        $user['address1'] = $_POST['settings-company-address1'];
        $user['address2'] = $_POST['settings-company-address2'];
        $user['company_code'] = $_POST['settings-company-number'];
        $user['city'] = $_POST['settings-invoice-city'];
        $user['bank'] = $_POST['settings-invoice-bank'];
        $user['account_no'] = $_POST['settings-invoice-account-no'];
        $user['additional_info'] = $_POST['settings-additional-info'];

        // Get changed data into $_SESSION['user']
        $_SESSION['user'] = $user;
}

header('Location: ../settings.php');
exit();
?>