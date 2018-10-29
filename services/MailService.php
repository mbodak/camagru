<?php

class MailService
{
    private static function createLinkWithCode($link, $code) {
        $arr = explode('/', $_SERVER['PHP_SELF']);
        if(!empty($arr[count($arr)-1])) {
            unset($arr[count($arr)-1]);
        }
        if(!empty($arr[count($arr)-1])) {
            unset($arr[count($arr)-1]);
        }
        $file = implode('/',$arr);
        $file .= '/'.$link;
        return $_SERVER["REQUEST_SCHEME"]."://".$_SERVER['HTTP_HOST'].$file."?code=".$code;
    }
    private static function send($mail_to, $mail_subject, $mail_message) {
        $lineBreak = "\r\n";
        $encoding = "utf-8";
        $subject_preferences = array(
            "input-charset" => $encoding,
            "output-charset" => $encoding,
            "line-length" => 76,
            "line-break-chars" => $lineBreak
        );
        $from_mail = "noreply@".$_SERVER['HTTP_HOST'];
        $from_name = "noreply";
        $header = "Content-type: text/html; charset=".$encoding.$lineBreak;
        $header .= "From: ".$from_name." <".$from_mail.">".$lineBreak;
        $header .= "Reply-To: ".$from_mail.$lineBreak;
        $header .= "MIME-Version: 1.0".$lineBreak;
        $header .= "X-Mailer: PHP/".phpversion().$lineBreak;
        $header .= "Content-Transfer-Encoding: 8bit".$lineBreak;
        $header .= "Date: ".date("r (T)").$lineBreak;
        $header .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);
        mail($mail_to, $mail_subject, $mail_message, $header);
    }
    public static function registerConfirmation($email, $code) {
        $link = self::createLinkWithCode('activate', $code);
        $subject = "Camagru registration!";
        $message = "Confirm your registration:<br>".$link."<br>";
        self::send($email, $subject, $message);
    }

    public static function restorePasswordConfirmation($email, $code) {
        $link = self::createLinkWithCode('confirm', $code);
        $subject = "Camagru restore password!";
        $message = "Restore your password:<br>".$link."<br>";
        self::send($email, $subject, $message);
    }
    public static function likeNotification($email) {
        $subject = "Camagru like!";
        $message = "New like at one of your photo!";
        self::send($email, $subject, $message);
    }
}