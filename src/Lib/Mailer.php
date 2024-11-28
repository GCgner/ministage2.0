<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

class Mailer {
    private PHPMailer $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer();
        $mailer->IsSMTP();
        $mailer->Host = 'smtp-relay.google.com';
        $mailer->port = '465';
        $mailer->SMTPAuth = 1;

        if($mailer->SMTPAuth) {
            $mailer->SMTPSecure = 'ssl';
            $mailer->Username = "";
            $mailer->Password = "";
        }
    }
    
    public function sendMail()
    {

    }
}