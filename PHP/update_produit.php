 <?php 
// function recuper_produit($id) {
    // global $nom, $pu, $desc, $coul, $qte, $lib_cat, $lib_marq,$marq_id,$cat_id,$val_enr,$photos;
    // try {
        // include("connexion_bd.php");
        // $sql = "SELECT p.Id_pro,p.Nom_pro, p.PU_pro, p.Desc_pro,p.url_pro, p.Coul_pro, p.Qte_pro, c.Id_cat, c.Lib_Cat,m.Id_marq, m.Lib_marq 
        //         FROM produit p 
        //         INNER JOIN cathegories c ON p.Id_cat = c.Id_cat
        //         INNER JOIN marques m ON p.Id_marq = m.Id_marq
        //         WHERE p.Id_pro = :id";
        // $stmt = $db->prepare($sql);
        // $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // $stmt->execute();

        // if ($stmt->rowCount() > 0) {
        //     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //         $nom = $row['Nom_pro'];
        //         $pu = $row['PU_pro'];
        //         $desc = $row['Desc_pro'];
        //         $coul = $row['Coul_pro'];
        //         $photos=$row['url_pro'];
        //         $qte = $row['Qte_pro'];
        //         $lib_cat = $row['Lib_Cat'];
        //         $cat_id=$row['Id_cat'];
        //         $lib_marq = $row['Lib_marq'];
        //         $marq_id=$row['Id_marq'];
        //         $val_enr=$row['Id_pro'];
        //     }
        // } else {
        //     echo "Aucun produit trouvé pour l'ID $id";
//         }
//     } catch (PDOException $e) {
//         echo "Erreur : " . $e->getMessage();
//     }
// }


//         function update_produit($id) {
//             global $names,$descriptions,$price,$quantity,$coulorr,$category_id,$brand_id;
//             try {
//                 include("connexion_bd.php")
        
//                 $sql = "UPDATE produit 
                //         SET Nom_pro = :names, 
                //             PU_pro = :price, 
                //             Desc_pro = :descriptions,
                //             url_pro= :photo,
                //             Coul_pro = :coulorr, 
                //             Qte_pro = :quantity, 
                //             Id_cat = :category_id, 
                //             Id_marq = :brand_id
                //         WHERE Id_pro = :id";
        
                // $stmt = $db->prepare($sql);
        
                // $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                // $stmt->bindParam(':names', $names, PDO::PARAM_STR);
                // $stmt->bindParam(':price', $price, PDO::PARAM_INT);
                // $stmt->bindParam(':photo', $photo, PDO::PARAM_INT);
                // $stmt->bindParam(':descriptions', $descriptions, PDO::PARAM_STR);
                // $stmt->bindParam(':coulorr', $coulorr, PDO::PARAM_STR);
                // $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                // $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
                // $stmt->bindParam(':brand_id', $brand_id, PDO::PARAM_INT);
        
                // $stmt->execute(); 
        
                // Vérifier si des lignes ont été affectées
        //         if ($stmt->rowCount() > 0) {
        //             echo"<script>alert(<h3><font color=blue>Enregistrement mis à jour avec succès.</font></h3>);</script>";
        //             header('location:acc_produit.php');
        //         } else {
        //             echo '<h3><div class="alert alert-danger"><em>Aucune mise à jour effectuée.</em></div></h3>';
        //         }
        
        //     } catch (PDOException $e) {
        //         echo "Erreur : " . $e->getMessage();
        //     }
        // }
        

        // function afficher_marque(){
        //     include("connexion_bd.php");
             
        //     $query = $db->query("SELECT * FROM marques");
                       
        
        //        while ($row = $query->fetch(PDO::FETCH_ASSOC))
        //        {
        //             echo 'Sélectionnez une catégorie';
        //             echo '<option value="'.$row['Id_marq'].'">';
        //             echo $row['Lib_marq'];
        //             echo '</option>';
        //        }
        //    }
        
        
        
        //    function afficher_cathegorie(){
        //     include("connexion_bd.php");
             
        //     $query = $db->query("SELECT * FROM cathegories");
                       
        
        //        while ($row = $query->fetch(PDO::FETCH_ASSOC))
        //        {
        //             echo 'Sélectionnez une catégorie';
        //             echo '<option value="'.$row['Id_cat'].'">';
        //             echo $row['Lib_Cat'];
        //             echo '</option>';
        //        }
        //    }
//             

    // $nom="";
    // $pu="";
    // $desc="";
    // $coul="";
    // $qte="";
    // $lib_cat="";
    // $lib_marq="";
    // $photos="";
    // $cat_id="";
    // $marq_id="";
    // $val_enr="";

    // if(isset($_GET['id'])){
    //     $id = $_GET['id'];
    //     recuper_produit($id);
    // }
//         $names = isset($_POST['name']) && !empty($_POST['name']) ? $_POST['name'] : $nom;
//         $descriptions = isset($_POST['description']) && !empty($_POST['description']) ? $_POST['description'] : $desc;
//         $price = isset($_POST['price']) && !empty($_POST['price']) ? $_POST['price'] : $pu;
//         $coulorr = isset($_POST['coul']) && !empty($_POST['coul']) ? $_POST['coul'] : $coul;
//         $quantity = isset($_POST['quantity']) && !empty($_POST['quantity']) ? $_POST['quantity'] : $qte;
//         $category_id = isset($_POST['category_id']) && !empty($_POST['category_id']) ? $_POST['category_id'] : $cat_id;
//         $brand_id = isset($_POST['brand_id']) && !empty($_POST['brand_id']) ? $_POST['brand_id'] : $marq_id;
//         $photo = isset($_POST['photo']) && !empty($_POST['photo']) ? $_POST['photo'] : $photos;


// $nom = isset($_POST['name']) && !empty($_POST['name']) ? $_POST['name'] : $nom;
// $desc = isset($_POST['description']) && !empty($_POST['description']) ? $_POST['description'] : $desc;
// $pu = isset($_POST['price']) && !empty($_POST['price']) ? $_POST['price'] : $pu;
// $coul = isset($_POST['coul']) && !empty($_POST['coul']) ? $_POST['coul'] : $coul;
// $qte = isset($_POST['quantity']) && !empty($_POST['quantity']) ? $_POST['quantity'] : $qte;
// $cat_id = isset($_POST['category_id']) && !empty($_POST['category_id']) ? $_POST['category_id'] : $cat_id;
// $marq_id = isset($_POST['brand_id']) && !empty($_POST['brand_id']) ? $_POST['brand_id'] : $marq_id;
// $val_enr = isset($_POST['modifier']) && !empty($_POST['modifier']) ? $_POST['modifier'] : $val_enr;

//     if(isset($_POST['modifier'])){
    //     $id=$_POST['modifier'];
    //     update_produit($id);
    // }

    // include("../html/update_produit.html");
// ?>




<?php 
function recuper_produit($id) {
    global $nom, $pu, $desc, $coul, $qte, $lib_cat, $lib_marq, $marq_id, $cat_id, $val_enr, $photos, $garan, $nat;
    try {
        include("connexion_bd.php");
        $sql = "SELECT p.Id_pro,p.Nom_pro,p.Natur_produit,p.Garanti_pro, p.PU_pro, p.Desc_pro,p.url_pro, p.Coul_pro, p.Qte_pro, c.Id_cat, c.Lib_Cat,m.Id_marq, m.Lib_marq 
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
                $garan = $row['Garanti_pro'];
                $nat = $row['Natur_produit'];
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

function supprime_image($id){
    try{

        include("connexion_bd.php");
        // Sélectionner l'URL de l'image à partir de la base de données
        $sql = "SELECT url_pro FROM produit WHERE Id_pro=:id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Spécifiez le chemin d'accès de l'image à supprimer
                $chemin_image_a_supprimer = $row['url_pro'];

                // Vérifiez si le fichier existe avant de tenter de le supprimer
                if (file_exists($chemin_image_a_supprimer)) {
                    // Supprimez le fichier
                    if (unlink($chemin_image_a_supprimer)) {
                        echo "L'image a été supprimée avec succès.";
                    } else {
                        echo "Erreur lors de la suppression de l'image.";
                    }
                } else {
                    echo "L'image n'existe pas.";
                }
            }
        } else {
            echo "Aucune image associée à cet ID de produit.";
        }
    } catch(Exception $e){
        die('Erreur:'.$e->getMessage());
    }
}


function update_produit($id,$photos) {
    global $names,$descriptions,$price,$quantity,$coulorr,$category_id,$brand_id,$photo,$garantie,$nature;
    try {
        include("connexion_bd.php");
        if(isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            // Supprimer l'ancienne image
            supprime_image($id);
        
            // Chemin du répertoire où vous souhaitez stocker les images
            $target_dir = "C:/wamp64/www/vrai projet soutenance/Image/appareil/";
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
                echo "Désolé, nous ne pouvons pas télécharger votre image.";
            // Si tout est ok, essayez de télécharger le fichier
            } else {
                $nom_photo = $names.".". $imageFileType;
                if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                    $photo = "../image/appareil/".$nom_photo; // Définir le chemin d'accès de l'image dans la variable $photo
                } else {
                   echo "Désolé, nous ne pouvons pas télécharger votre image.";
                }
            }
        }else{
            $photo=$photos;
        }
        $sql = "UPDATE produit 
                SET Nom_pro = :names, 
                    PU_pro = :price, 
                    Desc_pro = :descriptions,
                    url_pro= :photo,
                    Coul_pro = :coulorr, 
                    Qte_pro = :quantity,
                    Garanti_pro = :garantie,
                    Etats_pro = :etats,
                    Natur_produit = :nature,
                    Id_cat = :category_id, 
                    Id_marq = :brand_id
                WHERE Id_pro = :id";

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':names', $names, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_INT);
        $stmt->bindParam(':photo', $photo, PDO::PARAM_STR);
        $stmt->bindParam(':descriptions', $descriptions, PDO::PARAM_STR);
        $stmt->bindParam(':coulorr', $coulorr, PDO::PARAM_STR);
        $stmt->bindParam(':garantie', $garantie, PDO::PARAM_STR);
        $stmt->bindParam(':nature', $nature, PDO::PARAM_STR);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $etat = ($quantity > 0) ? "disponible" : "indisponible";
        $stmt->bindParam(':etats', $etat, PDO::PARAM_STR);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':brand_id', $brand_id, PDO::PARAM_INT);

        $stmt->execute();

        // Vérifier si des lignes ont été affectées
        if ($stmt->rowCount() > 0) {
            echo "<script>alert('<h3><font color=blue>Enregistrement mis à jour avec succès.</font></h3>');</script>";
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
               
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="'.$row['Id_marq'].'">';
        echo $row['Lib_marq'];
        echo '</option>';
    }
}

function afficher_cathegorie(){
    include("connexion_bd.php");
     
    $query = $db->query("SELECT * FROM cathegories");
               
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="'.$row['Id_cat'].'">';
        echo $row['Lib_Cat'];
        echo '</option>';
    }
}

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

    $names = isset($_POST['name']) && !empty($_POST['name']) ? $_POST['name'] : $nom;
    $descriptions = isset($_POST['description']) && !empty($_POST['description']) ? $_POST['description'] : $desc;
    $price = isset($_POST['price']) && !empty($_POST['price']) ? $_POST['price'] : $pu;
    $coulorr = isset($_POST['coul']) && !empty($_POST['coul']) ? $_POST['coul'] : $coul;
    $quantity = isset($_POST['quantity']) && !empty($_POST['quantity']) ? $_POST['quantity'] : $qte;
    $category_id = isset($_POST['category_id']) && !empty($_POST['category_id']) ? $_POST['category_id'] : $cat_id;
    $brand_id = isset($_POST['brand_id']) && !empty($_POST['brand_id']) ? $_POST['brand_id'] : $marq_id;
    $garantie = isset($_POST['garantie']) && !empty($_POST['garantie']) ? $_POST['garantie'] : $garantie;
    $nature = isset($_POST['nature']) && !empty($_POST['nature']) ? $_POST['nature'] : $nature;
    // $photo = !empty($photo) ? $photos : '';

    update_produit($id,$photos);
}

include("../html/update_produit.html");
?>
