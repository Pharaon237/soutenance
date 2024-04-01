<?php
// Importer la classe PHPMailer
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

// Charger PHPMailer via Composer
require '../vendor/autoload.php';

// Créer une nouvelle instance de PHPMailer
$mail = new PHPMailer(true);

try {
    // Paramètres SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'pernelpianne02@gmail.com'; // Votre adresse Gmail
    $mail->Password = 'Pernel2@24'; // Votre mot de passe Gmail
    $mail->SMTPSecure = 'tls'; // SSL/TLS
    $mail->Port = 587; // Port SMTP de Gmail

    // Destinataire et expéditeur
    $mail->setFrom('pernelpianne02@gmail.com', 'Pernel Pianne');
    $mail->addAddress('foudjitchouatavladimir@gmail.com', 'Vladimir');

    // Contenu de l'e-mail
    $mail->isHTML(true); // Le contenu est HTML
    $mail->Subject = 'Sujet de l\'e-mail';
    $mail->Body = 'Contenu de l\'e-mail';

    // Envoyer l'e-mail
    $mail->send();
    echo 'L\'e-mail a été envoyé avec succès.';
} catch (Exception $e) {
    echo 'Une erreur s\'est produite lors de l\'envoi de l\'e-mail : ', $mail->ErrorInfo;
}
?>




<?php
 include '../html/notification.html';
?>