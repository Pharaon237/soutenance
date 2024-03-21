<?php 
function recuper_produit($id) {
    global $nom, $pu, $desc, $coul, $qte, $lib_cat, $lib_marq,$marq_id,$cat_id,$val_enr;
    try {
        include("connexion_bd.php");
        $sql = "SELECT p.Id_pro,p.Nom_pro, p.PU_pro, p.Desc_pro,p.url_pro, p.Coul_pro, p.Qte_pro, c.Id_cat, c.Lib_Cat,m.Id_marq, m.Lib_marq 
                FROM produit p 
                INNER JOIN cathegories c ON p.Id_cat = c.Id_cat
                INNER JOIN marques m ON p.Id_marq = m.Id_marq
                WHERE p.Id_pro = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $nom = $row['Nom_pro'];
                $pu = $row['PU_pro'];
                $desc = $row['Desc_pro'];
                $coul = $row['Coul_pro'];
                $photos=$row['url_pro'];
                $qte = $row['Qte_pro'];
                $lib_cat = $row['Lib_Cat'];
                $cat_id=$row['Id_cat'];
                $lib_marq = $row['Lib_marq'];
                $marq_id=$row['Id_marq'];
                $val_enr=$row['Id_pro'];
            }
        } else {
            echo "Aucun produit trouvé pour l'ID $id";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}


        function update_produit($id) {
            global $names,$descriptions,$price,$quantity,$coulorr,$category_id,$photo,$brand_id;
            try {
                include("connexion_bd.php");

                // Vérifier si un fichier a été téléchargé
                if(isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                    $target_dir = "C:/wamp64/www/vrai projet soutenance/Image/appareil/"; // Le répertoire où vous souhaitez stocker les images
                    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $nom_photo = $names.".".$imageFileType;
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
                        $nom_photo = $names.".". $imageFileType;
                        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                            $photo = "../image/appareil/".$nom_photo; // Définir le chemin d'accès de l'image dans la variable $photo
                        } else {
                            echo "Desoler nous ne pouvons pas telecharger votre image";
                        }
                    }
                }
        
                $sql = "UPDATE produit 
                        SET Nom_pro = :names, 
                            PU_pro = :price, 
                            Desc_pro = :descriptions,
                            url_pro= :photo,
                            Coul_pro = :coulorr, 
                            Qte_pro = :quantity, 
                            Id_cat = :category_id, 
                            Id_marq = :brand_id
                        WHERE Id_pro = :id";
        
                $stmt = $db->prepare($sql);
        
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->bindParam(':names', $names, PDO::PARAM_STR);
                $stmt->bindParam(':price', $price, PDO::PARAM_INT);
                $stmt->bindParam(':photo', $photo, PDO::PARAM_INT);
                $stmt->bindParam(':descriptions', $descriptions, PDO::PARAM_STR);
                $stmt->bindParam(':coulorr', $coulorr, PDO::PARAM_STR);
                $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
                $stmt->bindParam(':brand_id', $brand_id, PDO::PARAM_INT);
        
                $stmt->execute();
        
                // Vérifier si des lignes ont été affectées
                if ($stmt->rowCount() > 0) {
                    echo"<script>alert(<h3><font color=blue>Enregistrement mis à jour avec succès.</font></h3>);</script>";
                    header('location:acc_produit.php');
                } else {
                    echo '<h3><div class="alert alert-danger"><em>Aucune mise à jour effectuée.</em></div></h3>';
                }
        
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
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

    $nom="";
    $pu="";
    $desc="";
    $coul="";
    $qte="";
    $lib_cat="";
    $lib_marq="";
    $photos="";
    $cat_id="";
    $marq_id="";
    $val_enr="";

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        recuper_produit($id);
    }
    

    if(isset($_POST['modifier'])){
        $id=$_POST['modifier'];

        recuper_produit($id);
    if(isset($_POST['name'])){
        $names=$_POST['name'];
    }else{
        $names=$nom;
    }

    if(isset($_POST['price'])){
        $price=$_POST['price'];
    }else{
        $price=$pu;
    }

    if(isset($_POST['description'])){
        $descriptions=$_POST['description'];
    }else{
        $descriptions=$desc;
    }

    if(isset($_POST['photo'])){
        $photo=$_POST['photo'];
    }else{
        $photo=$photos;
    }

    if(isset($_POST['quantity'])){
        $quantity=$_POST['quantity'];
    }else{
        $quantity=$qte;
    }

    if(isset($_POST['brand_id'])){
        $brand_id=$_POST['brand_id'];
    }else{
        $brand_id=$marq_id;
    }

    if(isset($_POST['category_id'])){
        $category_id=$_POST['category_id'];
    }else{
        $category_id=$cat_id;
    }

    if(isset($_POST['coul'])){
        $coulorr=$_POST['coul'];
    }else{
        $coulorr=$coul;
    }

        update_produit($id);
    }

    include("../html/update_produit.html");
?>