
    <?php
    function Enregistrer_utilisateur(){
        global $fullname, $names, $email, $password, $compt, $photo;
        try{
            include("connexion_bd.php");
            var_dump ($_FILES);
    
            // Vérifier si un fichier a été téléchargé
            if(isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $target_dir = "C:/wamp64/www/vrai projet soutenance/Image/utilisateur/"; // Le répertoire où vous souhaitez stocker les images
                $target_file = $target_dir . basename($_FILES["photo"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $nom_photo = $fullname.".". $imageFileType;
                $target_file = $target_dir . $nom_photo;
    
                // Vérifie si le fichier est une image réelle ou une fausse image
                $check = getimagesize($_FILES["photo"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                }
    
                // Vérifie la taille du fichier
                if ($_FILES["photo"]["size"] > 500000) {
                    $uploadOk = 0;
                }
    
                // Autorise certains formats de fichier
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    $uploadOk = 0;
                }
    
                // Vérifie si $uploadOk est défini à 0 par une erreur
                if ($uploadOk == 0) {
                    echo "Desoler nous ne pouvons pas telecharger votre image";

                // Si tout est ok, essayez de télécharger le fichier
                } else {
                    $nom_photo = $fullname.".". $imageFileType;
                    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                        $photo = "../image/".$nom_photo; // Définir le chemin d'accès de l'image dans la variable $photo
                    } else {
                        $photo="../image/utilisateur/avatar.jpg";
                         echo "Desoler nous ne pouvons pas telecharger votre image";
                    }
                }
            }else{
                $photo="../image/utilisateur/avatar.jpg";
            }
    
            // Maintenant, vous pouvez insérer les données dans la base de données
            $sql = "INSERT INTO utilisateurs (Nom_util, Prenom_util, email_util, Pwd_util, url_photo,Id_rôle) VALUES (:nom, :prenom, :email, :pwd, :photo, :compt)";
            $sql = $db->prepare($sql);
            $sql->bindValue(':nom', $fullname);
            $sql->bindValue(':prenom', $names);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':photo', $photo); // Insérer le chemin d'accès de l'image dans la base de données
            $sql->bindValue(':pwd', $password);
            $sql->bindValue(':compt', $compt);
            $sql->execute();
    
            if($sql){
                echo"<script>alert(<h3><font color=blue>insertion réussie</font></h3>);</scritp>";
                session_start();
                $_SESSION['nom']=$fullname;
                $_SESSION['prenom']=$names;
                $_SESSION['email']=$email;
                $_SESSION['photo']=$photo;
                $sql->closecursor();
                header('location:index.php');
            } else {
                echo "<h3><font color=red>Echec d'insertion </font></h3>";
            }
            $sql->closecursor();
        } catch(Exception $e) {
            die('Erreur:'.$e->getMessage());
        }
    }
    ?>
    

<?php
$fullname="";
$names="";
$email="";
$password="";
$photo="";
$compt="2";
if(isset($_POST['fullname'])){
    $fullname=$_POST['fullname'];
}
if(isset($_POST['names'])){
    $names=$_POST['names'];
}
if(isset($_POST['email'])){
    $email=$_POST['email'];
}
if(isset($_POST['photo'])){
    $photo=$_POST['photo'];
}
if(isset($_POST['password'])){
    if(isset($_POST['confirmer_mot_de_passe'])){
        if($_POST['password']==$_POST['confirmer_mot_de_passe']){
            $key = "Super_Amind.Key";
            $password= encrypt($_POST['password'], $key);
        }
    }
}
if(isset($_POST['inscription'])){
    Enregistrer_utilisateur();
}
include '../html/inscription.html';
?>