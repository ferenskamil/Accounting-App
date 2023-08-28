<?php

/* This function insert data about mail in associative array
 */
function prepare_email_details(
        string $smtp_username ,
        string $smtp_password ,
        string $sender_mail ,
        string $sender_name ,
        string $recipient_mail ,
        string $recipient_name ,
        string $reply_to_mail ,
        string $reply_to_name ,
        string $subject
) : array
{
        return [
                'smtp_username' => $smtp_username,
                'smtp_password' => $smtp_password,
                'sender_mail' => $sender_mail,
                'sender_name' => $sender_name,
                'recipient_mail' => $recipient_mail,
                'recipient_name' => $recipient_name,
                'reply_to_mail' => $reply_to_mail,
                'reply_to_name' => $reply_to_name,
                'subject' => $subject
        ];
}