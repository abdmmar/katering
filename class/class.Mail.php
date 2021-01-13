<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);;
$dotenv->load();

class Mail
{
  public function sendMail($to, $name, $subject, $message)
  {
    $mail = new PHPMailer(true);

    try {
      //Server settings
      $mail->SMTPDebug = 0;                      // Enable verbose debug output
      $mail->isSMTP();                                            // Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
      $mail->Username   = $_ENV['EMAIL'];                     // SMTP username
      $mail->Password   = $_ENV['PASS'];                               // SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
      $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

      //Recipients
      $mail->setFrom($_ENV['EMAIL'], 'Hena Katering');
      $mail->addAddress($to, $name);     // Add a recipient
      $mail->addReplyTo($_ENV['EMAIL'], 'Hena Katering');

      // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body    = $message;
      $mail->AltBody = 'Selamat ' . $name . ' Registrasi akun kamu berhasil! ';

      $mail->send();
      echo 'Message has been sent';
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }
}
