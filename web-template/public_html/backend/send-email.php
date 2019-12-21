<?php
session_start();
/******************/
/* init VARIABLES */
/******************/
$settings = yaml_parse_file("../../config.yaml");
$APP_NAME = $settings["title"];
$to_email = $settings["email"];
$CAPTCHA_SECRET = $settings["recaptcha"]["priv"]; /* GET KEYS: https://www.google.com/recaptcha/admin#list */

function diee($mess){
    $_SESSION["error"] = $mess;
    $_SESSION["name"] = $_POST['name'];
    $_SESSION["from"] = $_POST['from'];
    $_SESSION["body"] = $_POST['body'];
    die(header("Location: ../#contact"));
}
/******************/
/* handle RECAPTCHA */
/******************/
$userIP = $_SERVER["REMOTE_ADDR"];
$recaptchaResponse = $_GET['g-recaptcha-response'];
$request = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$CAPTCHA_SECRET}&response={$recaptchaResponse}&remoteip={$userIP}");
if(!strstr($request, "true")) diee("Failed captcha");

/******************/
/* handle EMAIL */
/******************/
/* REMEMBER TO CHECK VPS ALLOWS 587 OUTGOING */

/* POST VALIDATION*/
if(!filter_var($_POST['from'], FILTER_VALIDATE_EMAIL)) diee("Not a valid email");
$from = $_POST['from'];

if(!isset($_POST['name'])) diee("What is your name?");
if(strlen($_POST['name']) > 200) diee("Your name is too long!");
$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

if(!isset($_POST['body'])) diee("You haven't told us anything!");
if(strlen($_POST['body']) > 10000) diee("Your message is too long! Press back if you have lost your essay!");
$body = filter_var($_POST['body'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer();
//$mail->SMTPDebug = 4;
$mail->CharSet = 'UTF-8';

$mail->IsSMTP();
$mail->Timeout    = 2;
$mail->Host       = "mail.maxemails.info";
$mail->SMTPAuth   = true;
$mail->Username   = "form@transferme.it";
$mail->Password   = "CBK8MBvS8gMUsi9iTxmlzDbELb8vTkw289";
$mail->SMTPSecure = 'TLS';
$mail->Port       = 587;

$mail->setFrom($from, "$from");
$mail->addAddress($to_email, '');
$mail->Subject  = "$APP_NAME Contact form - from $name";
$mail->Body     = $body;

$mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) );

if(!$mail->send()) {
    echo 'Message was not sent.';
    echo 'Mailer error: ' . $mail->ErrorInfo;
    diee("Please contact <a href='mailto:max@max.me.uk'>max@max.me.uk</a>");
} else {
    $_SESSION["email"] = "Thank you for your message. We will get back to you ASAP.";
    header("Location: ../#contact");
}

$mail->SmtpClose();