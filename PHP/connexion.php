<?php

session_start();

function recuper_utilisateur($email)
{
    include '../php/connexion_bd.php';
    try {
        $sql = 'SELECT *, rôles.lib_rôle AS role_utilisateur FROM utilisateurs JOIN rôles ON utilisateurs.Id_rôle = rôles.Id_rôle WHERE email_util=:email';
        $sql = $db->prepare($sql);
        $sql->bindValue(':email', $email);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $donnees = $sql->fetch(PDO::FETCH_ASSOC);

            return $donnees;
        } else {
            return false; // Utilisateur non trouvé
        }
    } catch (Exception $e) {
        exit('Erreur : '.$e->getMessage());
    }
}

function decrypt($encrypted_message, $key)
{
    $cipher = 'aes-256-cbc';
    $encrypted_message = base64_decode($encrypted_message);
    $iv_length = openssl_cipher_iv_length($cipher);
    $iv = substr($encrypted_message, 0, $iv_length);
    $encrypted = substr($encrypted_message, $iv_length);

    return openssl_decrypt($encrypted, $cipher, $key, OPENSSL_RAW_DATA, $iv);
}

// Récupération ou définition du nom de la session
$session_name = 'my_app_session';
session_name($session_name);
session_start();

$email = isset($_POST['email']) ? $_POST['email'] : '';
$mot_de_passe = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : '';
$pageName = isset($_GET['pageName']) ? $_GET['pageName'] : 'index.php';

if (isset($_POST['connecter'])) {
    $utilisateur = recuper_utilisateur($email);

    if ($utilisateur) {
        $key = 'Super_Amind.Key';
        $mot = decrypt($utilisateur['Pwd_util'], $key);

        if ($mot == $mot_de_passe) {
            // Création d'un identifiant de session unique
            session_regenerate_id(true);

            $_SESSION['id'] = $utilisateur['Id_util'];
            $_SESSION['nom'] = $utilisateur['Nom_util'];
            $_SESSION['prenom'] = $utilisateur['Prenom_util'];
            $_SESSION['email'] = $utilisateur['email_util'];
            $_SESSION['photo'] = $utilisateur['url_photo'];
            $_SESSION['nat'] = '0';
            $_SESSION['role'] = $utilisateur['lib_rôle'];

            if (isset($pageName) && $pageName != php) {
                header("Location: $pageName");
            } else {
                header('Location: index.php');
            }
            exit();
        } else {
            echo "<script>alert('Échec de l'authentification');</script>";
        }
    } else {
        echo "<script>alert('Utilisateur non trouvé');</script>";
    }
}

include '../html/connexion.html';
