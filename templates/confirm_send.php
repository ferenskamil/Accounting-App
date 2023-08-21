<!--
The following popup requires a JS "confirm_send.js" file to be placed at the end of the target script. 
 -->
<div class="<?php
        if (isset($_SESSION['e_send'])) {
                echo "confirm-send__shadow confirm-send__shadow--active";
        } else {
                echo "confirm-send__shadow";
        }
?>">
                <div class="confirm-send__pop-up">
                        <div class="confirm-send__pop-up-message">
                                <p>Are you sure you want to send invoice No.&nbsp;<span class="confirm-send-no"><?php 
                                        echo $invoice['no']
                                ?></span>?</p>
                                <div class="confirm-send__pop-up-message-preview">
                                        <div>
                                                <p><b>Invoice date: </b><span class="confirm-send-date">
                                                        <?php echo $invoice['date'] ?>
                                                </span></p>
                                                <p><b>City: </b><span class="confirm-send-city">
                                                        <?php echo $invoice['city'] ?>
                                                </span></p>
                                                <p><b>Bank: </b><span class="confirm-send-bank">
                                                        <?php echo $invoice['bank'] ?>
                                                </span></p>
                                                <p><b>Account no.: </b><br><span class="confirm-send-account-no">
                                                        <?php echo $invoice['account_no'] ?>
                                                </span></p>
                                                <p><b>Payment term.: </b><span class="confirm-send-term">
                                                        <?php echo $invoice['payment_term'] ?>
                                                </span></p>
                                                <p><b>To pay: </b><span class="confirm-send-to-pay">
                                                        <?php echo number_format($invoice['to_pay'], 2, ',',' ')." $" ?>
                                                </span></p>
                                        </div>
                                        <div>
                                                <h3>Bill to:</h3>
                                                <p class="confirm-send-name"><?php echo $invoice['customer_name'] ?></p>
                                                <p class="confirm-send-address1"><?php echo $invoice['customer_address1'] ?></p>
                                                <p class="confirm-send-address2"><?php echo $invoice['customer_address2'] ?></p>
                                                <p class="confirm-send-company-code"><?php echo "NIP: ".$invoice['customer_company_no'] ?></p>
                                        </div>
                                </div>
                                <label for="confirm-send__pop-up-email">Send to</label>
                                <input type="email" id="confirm-send__pop-up-email" placeholder="Enter the recipient's email address" value="<?php
                                        if (isset($_SESSION['recipient_email_input_content']))
                                        {
                                                echo $_SESSION['recipient_email_input_content'];
                                        }
                                        ?>">
                                <p class="send-error"><?php
                                        if (isset($_SESSION['e_send']))
                                        {
                                                echo $_SESSION['e_send'];
                                                unset($_SESSION['e_send']);
                                        }
                                ?></p>
                        </div>
                        <div class="confirm-send__pop-up-buttons">
                                <form action="./invoice_edit.php" method="post">
                                        <input hidden type="text" id="confirm-send-edit-btn-hidden-input" name="invoice_no_to_edit" value="<?php echo $invoice_no_to_display ?>">
                                        <button type="submit" class="confirm-send__pop-up-buttons-edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                                Edit</button>
                                </form>
                                <form action="./php_scripts/mail/send_mail.php" method="post">
                                        <input hidden type="text" id="confirm-send-send-btn-hidden-input" name="invoice_no_to_send"     value="<?php echo $invoice_no_to_display ?>">
                                        <input hidden type="text" id="pop-up-email-hidden-input" name="recipient_mail" value="<?php
                                                if (isset($_SESSION['recipient_email_input_content']))
                                                {
                                                        echo $_SESSION['recipient_email_input_content'];
                                                }
                                        ?>">
                                        <button type="submit" class="confirm-send__pop-up-buttons-send">
                                                <i class="fa-solid fa-paper-plane"></i>
                                                Send</button>
                                </form>
                                <button class="confirm-send__pop-up-buttons-return">Return</button>
                        </div>
                </div>
        </div>