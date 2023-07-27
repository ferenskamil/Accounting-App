<?php

session_start();

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
                login = :login");
        $db_query->bindvalue(':company_name', $_POST['settings-company-name'], PDO::PARAM_STR);
        $db_query->bindvalue(':address1', $_POST['settings-company-address1'], PDO::PARAM_STR);
        $db_query->bindvalue(':address2', $_POST['settings-company-address2'], PDO::PARAM_STR);
        $db_query->bindvalue(':company_number', $_POST['settings-company-number'], PDO::PARAM_STR);
        $db_query->bindvalue(':city', $_POST['settings-invoice-city'], PDO::PARAM_STR);
        $db_query->bindvalue(':bank_name', $_POST['settings-invoice-bank'], PDO::PARAM_STR);
        $db_query->bindvalue(':account_no', $_POST['settings-invoice-account-no'], PDO::PARAM_STR);
        $db_query->bindvalue(':additional_info', $_POST['settings-additional-info'], PDO::PARAM_STR);
        $db_query->bindvalue(':login', $_SESSION['login'], PDO::PARAM_STR);
        $db_query->execute();

        // set session variables
        $_SESSION['company_name'] = $_POST['settings-company-name'];
        $_SESSION['address1'] = $_POST['settings-company-address1'];
        $_SESSION['address2'] = $_POST['settings-company-address2'];
        $_SESSION['company_number'] = $_POST['settings-company-number'];
        $_SESSION['default_invoice_city'] = $_POST['settings-invoice-city'];
        $_SESSION['default_invoice_bank_name'] = $_POST['settings-invoice-bank'];
        $_SESSION['default_invoice_bank_account_no'] = $_POST['settings-invoice-account-no'];
        $_SESSION['default_invoice_additional_info'] = $_POST['settings-additional-info'];
}

header('Location: ../settings.php');
exit();
?>