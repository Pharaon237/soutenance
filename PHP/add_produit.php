<?php
    function Enregistrer_produit(){
        global $name,$description,$price,$quantity,$coul,$category_id,$photo,$brand_id;
        try{
            include("connexion_bd.php");

            // Vérifier si un fichier a été téléchargé
            if(isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $target_dir = "C:/wamp64/www/vrai projet soutenance/Image/appareil/"; // Le répertoire où vous souhaitez stocker les images
                $target_file = $target_dir . basename($_FILES["photo"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $nom_photo = $name.".".$imageFileType;
                $target_file = $target_dir.$nom_photo;
    
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
                    $nom_photo = $name.".". $imageFileType;
                    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                        $photo = "../image/appareil/".$nom_photo; // Définir le chemin d'accès de l'image dans la variable $photo
                    } else {
                        echo "Desoler nous ne pouvons pas telecharger votre image";
                    }
                }
            }

        //insertion les données dans la base de données
            $sql="INSERT INTO produit(Nom_pro,PU_pro,Desc_pro,url_pro,Coul_pro,Qte_pro,Id_cat,Id_marq) values(:nom,:pu,:dscr,:photo,:coul,:qte,:cat,:marq)";
            $sql=$db->prepare($sql);
            $sql -> bindvalue(':nom',$name);
            $sql -> bindvalue(':pu',$price);
            $sql -> bindvalue(':dscr',$description);
            $sql -> bindvalue(':photo',$photo);
            $sql -> bindvalue(':coul',$coul);
            $sql -> bindvalue(':qte',$quantity);
            $sql -> bindvalue(':cat',$category_id);
            $sql -> bindvalue(':marq',$brand_id);
            $sql -> execute();
            if($sql){
                echo"<script>alert(<h3><font color=blue>insertion réussie</font></h3>);</script>";
                header('location:acc_produit.php');
            }
            else{
                echo '<h3><div class="alert alert-danger"><em>Echec d\'insertion</em></div></h3>';
            }
            $sql->closecursor();
        }catch(Exception $e){
            die('Erreur:'.$e->getMessage());
        }
    }

        function afficher_marque(){
    include("connexion_bd.php");
     
    $query = $db->query("SELECT * FROM marques");
               

       while ($row = $query->fetch(PDO::FETCH_ASSOC))
       {
            echo 'Sélectionnez une catégorie';
            echo '<option value="'.$row['Id_marq'].'">';
            echo $row['Lib_marq'];
            echo '</option>';
       }
   }



   function afficher_cathegorie(){
    include("connexion_bd.php");
     
    $query = $db->query("SELECT * FROM cathegories");
               

       while ($row = $query->fetch(PDO::FETCH_ASSOC))
       {
            echo 'Sélectionnez une catégorie';
            echo '<option value="'.$row['Id_cat'].'">';
            echo $row['Lib_Cat'];
            echo '</option>';
       }
   }
?>


<?php

    $name="";
    $price="";
    $description="";
    $quantity="";
    $photo="";
    $brand_id="";
    $category_id="";
    $coul="";


    if(isset($_POST['name'])){
        $name=$_POST['name'];
    }
    if(isset($_POST['price'])){
        $price=$_POST['price'];
    }
    if(isset($_POST['description'])){
        $description=$_POST['description'];
    }
    if(isset($_POST['photo'])){
        $photo=$_POST['photo'];
    }
    if(isset($_POST['quantity'])){
        $quantity=$_POST['quantity'];
    }
    if(isset($_POST['brand_id'])){
        $brand_id=$_POST['brand_id'];
    }
    if(isset($_POST['category_id'])){
        $category_id=$_POST['category_id'];
    }
    if(isset($_POST['coul'])){
        $coul=$_POST['coul'];
    }

    if(isset($_POST['ajouter'])){
        Enregistrer_produit();
    }

    
    include'..\html\add_pro.html';
?>