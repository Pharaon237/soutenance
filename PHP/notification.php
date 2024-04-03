<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require '../vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Paramètres SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.outlook.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'pernelpianne02@gmail.com'; // Votre adresse Gmail
    $mail->Password = 'Pernel2@24'; // Votre mot de passe Gmail
    $mail->SMTPSecure = 'tls'; // SSL/TLS
    $mail->Port = 587; // Port SMTP de Gmail

    // Destinataire et expéditeur
    $mail->setFrom('pernelpianne02@gmail.com', 'Pernel Pianne');
    $mail->addAddress('annysmile549@gmail.com', 'SMILE');

    // Contenu de l'e-mail (le contenu de la facture généré par facture.php)
    ob_start(); // Démarrer la capture de sortie
    include '../php/facture.php'; // Inclure le contenu de la facture généré par facture.php
    $content = ob_get_clean(); // Récupérer le contenu capturé et vider le tampon de sortie

    $mail->isHTML(true); // Le contenu est HTML
    $mail->Subject = 'Sujet de l\'e-mail';
    $mail->Body = $content;

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