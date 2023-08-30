<?php

abstract class Mail extends Model {

    public static function send($to, $sender, $subject, $message) {
        $headers = array();
        $headers[] = 'From: ' . constant('PAGE_NAME') . ' <' . $sender . '>';
        $headers[] = 'Reply-To: ' . $sender;
        $headers[] = 'X-Mailer: PHP/' . phpversion();
        $headers[] = 'Mime-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';

        if (mail($to, $subject, $message, implode("\r\n", $headers))) {
            saveMail($from_mail, $from_name, $address, $subject, $body, $date_send, $status);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function saveMail($from_mail, $from_name, $address, $subject, $body, $date_send, $status) {
        $this->query('INSERT INTO messages (from_mail, from_name, address, subject, body, date_send, status)'
                . 'VALUES (?,?,?,?,?,?,?)', array($from_mail, $from_name, $address, $subject, $body, $date_send, $status));
    }

}
